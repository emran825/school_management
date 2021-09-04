<?php

namespace App\Http\Controllers;

use App\Jobs\UsersRegistrationConfirmationMailJob;
use App\Mail\SchoolUser;
use App\Mail\TestMail;
use App\Mail\UsersRegistrationConfirmationMail;
use App\Models\School;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserGroupMember;
use App\Traits\HasPermission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SchoolController extends Controller
{
    use HasPermission;


    public function __construct(Request $request)
    {
        $this->page_title   = $request->route()->getName();
        $description        = \Request::route()->getAction();
        $this->page_desc    = isset($description['desc']) ? $description['desc'] : $this->page_title;
    }

    public function schoolIndex(){
        $data['page_title'] 	= $this->page_title;
        $data['module_name']	= "Acadimic";
        $data['sub_module']		= "Subject";

        $admin_user_id  		= Auth::user()->id;
        $add_action_id  		= 94;
        $add_permission 		= $this->PermissionHasOrNot($admin_user_id,$add_action_id );
        $data['actions']['add_permission']= $add_permission;
        return view('school.index', $data);
    }

    public function schoolList()
    {
        $admin_user_id      = Auth::user()->id;
        $edit_action_id     = 95;
        $delete_action_id   = 96;

        $edit_permission    = $this->PermissionHasOrNot($admin_user_id, $edit_action_id);
        $delete_permission  = $this->PermissionHasOrNot($admin_user_id, $delete_action_id);

        $schoolList = School::Select('id', 'name', 'address', 'email', 'contact_no', 'principle_name', 'principle_contact_no', 'reference_person', 'reference_contact_no', 'registration_date', 'valid_till', 'remarks', 'status')->orderBy('created_at', 'desc')->get();
        $return_arr = array();

        foreach ($schoolList as $school) {

            $data['status']               = ($school->status == 'Active')?"<button class='btn btn-xs btn-success' disabled>Active</button>" : "<button class='btn btn-xs btn-danger' disabled>Inactive</button>";
            $data['name']                 = $school->name;
            $data['email']                = $school->email;
            $data['contact_no']           = $school->contact_no;
            $data['address']              = $school->address;
            $data['registration_date']    = $school->registration_date;

            $data['actions']		      =" <button title='View' onclick='school_detail_view(".$school->id.")' id='view_" . $school->id . "' class='btn btn-xs btn-info btn-hover-shine admin-user-view' ><i class='lnr-eye'></i></button>";
            if ($edit_permission > 0) {
                $data['actions']         .= " <button onclick='schoolEdit(" . $school->id . ")' id=edit_" . $school->id . "  class='btn btn-xs btn-hover-shine  btn-primary module-edit'><i class='lnr-pencil'></i></button>";
            }

            if ($delete_permission > 0) {
                $data['actions']           .= " <button onclick='schoolDelete(" . $school->id . ")' id='delete_" . $school->id . "' class='btn btn-xs btn-hover-shine btn-danger' ><i class='fa fa-trash'></i></button>";
            }

            $return_arr[] = $data;
        }

        return json_encode(array('data' => $return_arr));
    }

    public function schoolCreateOrEdit(Request $request){

        $admin_user_id      = Auth::user()->id;
        $add_permission     = $this->PermissionHasOrNot($admin_user_id, 94);
        $update_permission  = $this->PermissionHasOrNot($admin_user_id, 95);

        $request->request->add(['type'                  => 'School']);
        $request->request->add(['user_group_type_id'    => 2]);

        if(!is_null($request->input('id')) && $request->input('id') != "" && $update_permission){
            $response_data = $this->editSchool($request->all(), $request->input('id'));
        }
        else if($add_permission) {
            $response_data = $this->createSchool($request->all()); // new entry
        } else {
                $return['result'] = 0;
                $return['message'] = "You are not authorized to insert a Admin";
                $response_data = json_encode($return);

        }
        return $response_data;
    }

    private function createSchool ($request) {
        try {
            $rule = [
                'name'                  => 'required|string',
                'email'                 => 'Required|email',
                'contact_no'            => 'Required|max:18',
                'principle_name'        => 'Required',
                'reference_person'      => 'Required',
                'reference_contact_no'  => 'Required',
                'registration_date'     => 'Required',
            ];
            $validation = Validator::make($request, $rule);

            if ($validation->fails()) {
                return false;
            }
            else {
                $emailVerification = School::where('email', $request['email'])->first();
                if(isset($emailVerification->id)){
                    return false;
                }
                DB::beginTransaction();
                $school = School::create([
                    'name'                  => $request['name'],
                    'address'               => $request['address'],
                    'email'                 => $request['email'],
                    'contact_no'            => $request['contact_no'],
                    'principle_name'        => $request['principle_name'],
                    'principle_contact_no'  => $request['principle_contact_no'],
                    'reference_person'      => $request['reference_person'],
                    'reference_contact_no'  => $request['reference_contact_no'],
                    'registration_date'     => $request['registration_date'],
                    'valid_till'            => $request['valid_till'],
                    'remarks'               => $request['remarks'],
                    'status'                => (isset($request['is_active'])) ? 'Active' : 'Inactive'
                ]);
                $request['first_name']  = $request['principle_name'];
                $request['school_id']   = $school->id;

                if($school->id){
                    $user = User::createUser($request);
                    if($user==false){
                        throw new \Exception('School & School User');
                    }
                }else {
                    throw new \Exception('School User!');
                }
                DB::commit();
                $return['result']    = 1;
                $return['message']   = "School and  School User saved successfully";
                return json_encode($return);
           }
        } catch (\Exception $e) {
            DB::rollback();
            $return['result'] = 0;
            $return['message'] = "Failed to save !" . $e->getMessage();
            return json_encode($return);
        }
    }

    private function editSchool($request, $id){
        try {
            if($id == ""){
                return json_encode(array('result'=>0, 'message'=>"Invalid Request!"));
            }
            $school = School::findOrFail($id);
            if(empty($school)) {
                return json_encode(array('result' => 0, 'message' => "Invalid Request! No School Info Found!"));
            }
            $rule = [
                'name'                  => 'required|string',
                'email'                 => 'Required|email',
                'contact_no'            => 'Required|max:18',
                'principle_name'        => 'Required',
                'reference_person'      => 'Required',
                'reference_contact_no'  => 'Required',
                'registration_date'     => 'Required',
            ];
            $validation = Validator::make($request, $rule);

            if ($validation->fails()) {
                return false;
            } else {
                DB::beginTransaction();
                $status = (isset($request['is_active']))?'Active':'Inactive';
                $school->name                   = $request['name'];
                $school->address                = $request['address'];
                $school->email                  = $request['email'];
                $school->contact_no             = $request['contact_no'];
                $school->principle_name         = $request['principle_name'];
                $school->principle_contact_no   = $request['principle_contact_no'];
                $school->reference_person       = $request['reference_person'];
                $school->reference_contact_no   = $request['reference_contact_no'];
                $school->registration_date      = $request['registration_date'];
                $school->valid_till             = $request['valid_till'];
                $school->remarks                = $request['remarks'];
                $school->status                 = (isset($request['is_active'])) ? 'Active' : 'Inactive';
                $school->update();

                $userSchoolID = User::where('school_id', $school->id)->first();
                $request['first_name'] = $school->principle_name;
                $request['password'] = "";
                $userId = $userSchoolID->id;
                if($userId){
                    $user = User::editUser($request, $userId);
                    if($user==false){
                        throw new \Exception('School & School User');
                    }
                } else {
                    throw new \Exception('School User');
                }
                // if status changed to active or inactive
                if($school->status != $status) {
                    $user = User::where('school_id', '=', $school->id)->first();
                    $user->status = ($status == 'Active') ? 1 : 0;
                    $user->update();
                }
                DB::commit();
                $return['result'] = 1;
                $return['message'] = "School & School Admin Updated successfully";
                return json_encode($return);
            }
        } catch (\Exception $e) {
            DB::rollback();
            $return['result'] = 0;
            $return['message'] = "Failed to update !" . $e->getMessage();
            return json_encode($return);
        }
    }

    public function showSchoolDetails($id)
    {
        if ($id == "") return 0;
        $school = School::findOrFail($id);
        return json_encode(array('school' => $school));

    }

    public function schoolDestroy($id)
    {
        if ($id == "") {
            return json_encode(array('result' => 0, 'message' => "Invalid Request! "));
        }

        $school = School::with('users')->findOrFail($id);
        $is_deletable = (count($school->users)==0)?1:0;

        try {
            DB::beginTransaction();
            if($is_deletable){
                $user = User::with('user_groups')->where('school_id','=',$id)->first();
                UserGroupMember::where('user_id','=',$user->id)->delete();
                $user->delete();
                $school->delete();

                $return['message'] = "School Deleted successfully";
            }
            else {
                $school->status = 'Inactive';
                $school->update();

                $user = User::where('school_id', '=', $id)->first();
                $user->status = 0;
                $user->save();
                $return['message'] = "School Status successfully";
            }
            DB::commit();
            $return['result'] = 1;
            return json_encode($return);

        } catch (\Exception $e) {
            DB::rollback();
            $return['result'] = 0;
            $return['message'] = "Failed to delete !" . $e->getMessage();
            return json_encode($return);
        }
    }

//  **********************************  School Admin Users **********************************

    // School Admin Users
    public function schoolAdminIndex(){
        $page_title         = $this->page_title;
        $data['module_name']= "Dashboard";
        $data['sub_module']	= "Users";
        $data['schoolName']	= "School Admin";
        $admin_user_id 		= Auth::user()->id;
        $school             = School::where('status','Active')->get();
        $add_action_id  	= 100;
        $add_permission 	= $this->PermissionHasOrNot($admin_user_id, $add_action_id);
        $data['actions']['add_permission'] = $add_permission;
        return view('school.school-admin',['page_title'=>$page_title, $data, 'schools'=>$school]);
    }

    public function schoolAdminsList(){
        $admin_user_id 		= Auth::user()->id;
        $edit_action_id 	= 101;
        $delete_action_id 	= 102;
        $edit_permission 	= $this->PermissionHasOrNot($admin_user_id,$edit_action_id);
        $delete_permission 	= $this->PermissionHasOrNot($admin_user_id,$delete_action_id);
        $image_path = asset('assets/images/user/admin');
        $schoolId = Auth::user()->school_id;
        $schoolAdminUsersSql 	= User::Select('user_profile_image', 'id', DB::raw('CONCAT(first_name," ", ifnull(last_name,"")) as name'),  'email', 'school_id', 'status')
            ->where('type','=','School')
            ->with('school');
        if($schoolId) {
            $schoolAdminUsersSql->where('school_id','=',$schoolId);
        }
        $schoolAdminUsers = $schoolAdminUsersSql->orderBy('created_at','desc')->get();

        $return_arr = array();
        foreach($schoolAdminUsers as $user){
            $user['school_name'] = $user->school->name;

            if ($user->user_profile_image!="" || $user->user_profile_image!=null) {
                $user['user_profile_image'] = '<img height="40" width="50" src="'.$image_path.'/'.$user->user_profile_image.'" alt="image" />';
            }else{
                $user['user_profile_image'] = '<img height="40" width="50" src="'.$image_path.'/no-user-image.png'.'" alt="image" />';
            }
            if($user->status == 0){			$user['status']="<button class='btn btn-xs btn-danger' disabled>In-active</button>";}
            else if($user->status == 1){	$user['status']="<button class='btn btn-xs btn-success' disabled>Active</button>";}

            $user['actions']		 =" <button title='View' onclick='admin_school_view(".$user->id.")' id='view_" . $user->id . "' class='btn btn-xs btn-info btn-hover-shine admin_school_view' ><i class='lnr-eye'></i></button>";

            if($edit_permission>0){
                $user['actions'] 	.=" <button title='Edit' onclick='admin_school_edit(".$user->id.")' id=edit_" . $user->id . " class='btn btn-xs btn-hover-shine  btn-primary' ><i class='lnr-pencil'></i></button>";
            }

            if ($delete_permission > 0) {
                $user['actions']    .=" <button title='Delete' onclick='delete_admin_school(".$user->id.")' id='delete_" . $user->id . "' class='btn btn-xs btn-hover-shine btn-danger'><i class='fa fa-trash'></i></button>";
            }
            $return_arr[] = $user;
        }
        return json_encode(array('data'=>$return_arr));
    }

    public function SchoolAdminCreateOrEdit(Request $request){

        $admin_user_id      = Auth::user()->id;
        $schoolID           = Auth::user()->school_id;
        $add_permission     = $this->PermissionHasOrNot($admin_user_id, 100);
        $update_permission  = $this->PermissionHasOrNot($admin_user_id, 101);
        $request->request->add(['type'               => 'School']);
        $request->request->add(['user_group_type_id' => 2]);

        if(!is_null($request->id) && $request->id != "" && $update_permission){
            $response_data = User::editUser($request->all(), $request->id);
            if($response_data==false){
                $return['result'] = 0;
                $return['message'] = "School Admin User Update Failed!";
                $response_data = json_encode($return);
            }
        }
        else if($add_permission) {
            $response_data = User::createUser($request->all());
            if($response_data==false){
                $return['result'] = 0;
                $return['message'] = "School Admin User Save Failed!";
                $response_data = json_encode($return);
            }
        } else {
            $return['result'] = 0;
            $return['message'] = "You are not authorized to insert a User";
            $response_data = json_encode($return);
        }
        return $response_data;
    }

    public function SchooladminView($id){
        $data   = User::find($id);
        $groups = DB::table('user_group_members as ugm')
            ->leftJoin('user_groups as ug', 'ugm.group_id', '=', 'ug.id')
            ->select(DB::raw('group_concat("", ug.group_name, "") AS group_name'))
            ->where('ugm.user_id', $id)
            ->where('ugm.status', 1)
            ->get();
        return response()->json([
            'data'=>$data,
            'groups'=>$groups,
        ]);
    }

    public function schoolAdminDestroy($id){
        User::where('id',$id)->update(['status'=>0]);
        return json_encode(array(
            "deleteMessage"=>"Deleted Successful"
        ));
    }


}
