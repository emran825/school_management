<?php

namespace App\Http\Controllers;

use App\Jobs\UsersRegistrationConfirmationMailJob;
use App\Models\Classe;
use App\Models\ClassSubject;
use App\Models\School;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeacherSubject;
use App\Models\User;
use App\Models\UserGroupMember;
use App\Traits\HasPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    use HasPermission;
    public function __construct(Request $request)
    {
        $this->page_title = $request->route()->getName();
        $description = \Request::route()->getAction();
        $this->page_desc = isset($description['desc']) ? $description['desc'] : $this->page_title;
    }

    public function index()
    {
        $data['page_title'] 	= "Teacher";
        $data['module_name']	= "Academic";
        $data['sub_module']		= "Teachers";
        // action permissions
        $admin_user_id  		= Auth::user()->id;
        $data['userType']		= Auth::user()->type;
        $add_action_id  		= 108; // Teacher entry
        $add_permission 		= $this->PermissionHasOrNot($admin_user_id,$add_action_id );
        $data['actions']['add_permission']= $add_permission;
        return view('teacher.index',$data);
    }

    public function showList()
    {
        $admin_user_id  = Auth::user()->id;
        $userType       = Auth::user()->type;
        $school_ids     = Auth::user()->school_id;

        $edit_permission    = $this->PermissionHasOrNot($admin_user_id, 109);
        $delete_permission  = $this->PermissionHasOrNot($admin_user_id, 110);

        $teacherSql     = Teacher::Select('id', 'teacher_id', 'address', 'email', 'contact_no', 'first_name', 'middle_name', 'last_name', 'dob', 'nationality', 'gender', 'last_qualification', 'speciality', 'job_type', 'salary', 'remarks', 'status');
        $teachers       = $teacherSql->where('school_id', $school_ids)->orderBy('created_at', 'desc')->get();
        $return_arr     = array();

        foreach ($teachers as $teacher) {
            $data['actions'] = "";
            $data['status']             = ($teacher->status == 'Active') ? "<button class='btn btn-xs btn-success' disabled>Active</button>" : "<button class='btn btn-xs btn-danger' disabled> Inactive </button>";
            //$data['id']               = $teacher->id;
            $data['name']               = $teacher->first_name.' '.$teacher->middle_name.' '.$teacher->last_name;
            $data['teacher_id']         = $teacher->teacher_id;
            $data['email']              = $teacher->email;
            $data['contact_no']         = $teacher->contact_no;

            $data['actions']		=" <button title='View' onclick='teacherView(".$teacher->id.")' id='view_" . $teacher->id . "' class='btn btn-xs btn-info btn-hover-shine admin-user-view' ><i class='lnr-eye'></i></button>";
            if($edit_permission>0){
                $data['actions'] 	.=" <button title='Edit' onclick='teacherEdit(".$teacher->id.")' id=edit_" . $teacher->id . " class='btn btn-xs btn-hover-shine  btn-primary' ><i class='lnr-pencil'></i></button>";
            }
            if ($delete_permission > 0) {
                $data['actions'] .=" <button title='Delete' onclick='teacherDelete(".$teacher->id.")' id='delete_" . $teacher->id . "' class='btn btn-xs btn-hover-shine btn-danger'><i class='fa fa-trash'></i></button>";
            }
            $return_arr[] = $data;
        }
        return json_encode(array('data' => $return_arr));
    }

    public function createOrEdit(Request $request){

        $admin_user_id      = Auth::user()->id;
        $add_permission     = $this->PermissionHasOrNot($admin_user_id, 104);
        $update_permission  = $this->PermissionHasOrNot($admin_user_id, 105);

        $request->request->add(['type'               => 'Teacher']);
        $request->request->add(['user_group_type_id' => 3]);

        if(!is_null($request->input('id')) && $request->input('id') != "" && $update_permission){
            $response_data = $this->editTeacher($request->all(), $request->id);
        }
        else if($add_permission) {
            $response_data = $this->createTeacher($request->all()); // new entry
        } else {
            $return['result'] = 0;
            $return['message'] = "You are not authorized to insert a Admin";
            $response_data = json_encode($return);
        }
        return $response_data;
    }

    private function createTeacher ($request) {
        $adminId = Auth::user()->school_id;
        $id=DB::select("SHOW TABLE STATUS LIKE 'teachers'");
        $next_id=$id[0]->Auto_increment;
        $teacherIds = $adminId.''.date("y").'00'.$next_id;

        try {
            $rule = [
                'first_name'            => 'required',
                'address'               => 'required',
                'email'                 => 'Required|email',
                'contact_no'            => 'Required|max:18',
                'dob'                   => 'Required',
                'nationality'           => 'Required',
                'gender'                => 'Required',
                'last_qualification'    => 'Required',
                'speciality'            => 'Required',
                'job_type'              => 'Required',
            ];
            $validation = Validator::make($request, $rule);
            if ($validation->fails()) {
                return false;
            } else {
                $emailVerification = Teacher::where('email', $request['email'])->first();
                if(isset($emailVerification->id)){
                    return false;
                }
                DB::beginTransaction();
                $teacher = Teacher::create([
                    'school_id'          => Auth::user()->school_id,
                    'teacher_id'         => $teacherIds,
                    'address'            => $request['address'],
                    'email'              => $request['email'],
                    'contact_no'         => $request['contact_no'],
                    'first_name'         => $request['first_name'],
                    'middle_name'        => $request['middle_name'],
                    'last_name'          => $request['last_name'],
                    'dob'                => $request['dob'],
                    'gender'             => $request['gender'],
                    'nationality'        => $request['nationality'],
                    'last_qualification' => $request['last_qualification'],
                    'speciality'         => $request['speciality'],
                    'job_type'           => $request['job_type'],
                    'salary'             => $request['salary'],
                    'remarks'            => $request['remarks'],
                    'status'             => (isset($request['is_active'])) ? 'Active' : 'Inactive'
                ]);
                $request['typable_id'] = $teacher->id;
                if(Auth::user()->type == 'School'){
                    $request['school_id'] = Auth::user()->school_id;
                }
                if($teacher->id){
                    $user = User::createUser($request);
                    if($user==false){
                        throw new \Exception('Teacher & Teacher User');
                    }else {
                        if(isset($request['subject_id'])){
                            foreach($request['subject_id'] as $key => $subjectId) {
                                TeacherSubject::create(['class_subject_id' => $subjectId, 'teacher_id'=>$teacher->id]);
                            }
                        }
                    }
                } else {
                    throw new \Exception('User not create!');
                }
                DB::commit();
                $return['result']    = 1;
                $return['message']   = "Teacher saved successfully";
                return json_encode($return);
            }
        } catch (\Exception $e) {
            DB::rollback();
            $return['result'] = 0;
            $return['message'] = "Failed to save ! " . $e->getMessage();
            return json_encode($return);
        }
    }

    private function editTeacher($request, $id){
        try {
            if($id == ""){
                return json_encode(array('result'=>0, 'message'=>"Invalid Request!"));
            }
            $teacher = Teacher::findOrFail($id);
            if(empty($teacher)) {
                return json_encode(array('result' => 0, 'message' => "Invalid Request! No School Info Found!"));
            }
            $rule = [
                'first_name'            => 'required',
                'address'               => 'required',
                'email'                 => 'Required|email',
                'contact_no'            => 'Required|max:18',
                'dob'                   => 'Required',
                'nationality'           => 'Required',
                'gender'                => 'Required',
                'last_qualification'    => 'Required',
                'speciality'            => 'Required',
                'type'                  => 'Required',
            ];

            $validation = Validator::make($request, $rule);
            if ($validation->fails()) {
                return false;
            } else {
                DB::beginTransaction();
                $status = (isset($request['is_active']))?'Active':'Inactive';
                $teacher->teacher_id          = $request['teacher_id'];
                $teacher->address             = $request['address'];
                $teacher->email               = $request['email'];
                $teacher->contact_no          = $request['contact_no'];
                $teacher->first_name          = $request['first_name'];
                $teacher->middle_name         = $request['middle_name'];
                $teacher->last_name           = $request['last_name'];
                $teacher->dob                 = $request['dob'];
                $teacher->gender              = $request['gender'];
                $teacher->nationality         = $request['nationality'];
                $teacher->last_qualification  = $request['last_qualification'];
                $teacher->speciality          = $request['speciality'];
                $teacher->job_type            = $request['job_type'];
                $teacher->salary              = $request['salary'];
                $teacher->remarks             = $request['remarks'];
                $teacher->status              = $status;
                $teacher->update();

                $usertypeid = User::where('typable_id', $teacher->id)->first();
                $request['password'] = "";
                $userid = $usertypeid->id;
                if($userid && $teacher->id){
                    $user = User::editUser($request, $userid);
                    if($user==false){
                        throw new \Exception('Teacher & Teacher User');
                    }else {
                            foreach ($request['subject_id'] as $key => $subjectID) {
                                $teacherSubject[$subjectID] = ['class_subject_id' => $request['subject_id']];
                            }
                            $teacher = Teacher::find($id);
                            $teacher->teacher_subjects()->sync($teacherSubject[$subjectID]['class_subject_id']);
                    }
                } else {
                    throw new \Exception('User ID Not Found!');
                }

                // if status changed to active or inactive
                if($teacher->status != $status) {
                    $user           = User::where('typable_id', '=', $teacher->id)->first();
                    $user->status   = ($status == 'Active') ? 1 : 0;
                    $user->update();
                }
                DB::commit();
                $return['result'] = 1;
                $return['message'] = "Teacher Updated successfully";
                return json_encode($return);
            }
        } catch (\Exception $e) {
            DB::rollback();
            $return['result'] = 0;
            $return['message'] = "Failed to update ! " . $e->getMessage();
            return json_encode($return);
        }
    }

    public function show($id)
    {
        if ($id == "") return 0;
        $teacher = Teacher::with('teacher_subjects','teacher_subjects.subjects','teacher_subjects.classes','teacher_subjects.classes.KeyStages')->findOrFail($id);
        $user = User::where('typable_id', $id)->first();
        return json_encode(array('teacher' => $teacher, 'user'=>$user));
    }

    public function destroy($id){
        if ($id == "") {
            return json_encode(array('result' => 0, 'errors' => "Invalid Request! "));
        }
        $teacher = Teacher::with('users')->findOrFail($id);
        $is_deletable = (count($teacher->users)==0)?1:0;

        try {
            DB::beginTransaction();
            if($is_deletable){
                $user = User::with('user_groups')->where('typable_id','=',$id)->first();
                UserGroupMember::where('user_id','=',$user->id)->delete();
                $user->delete();
                $teacher->delete();
                $return['message'] = "School Deleted successfully";
            }
            else {
                $teacher->status = 'Inactive';
                $teacher->update();

                $user = User::where('typable_id', '=', $id)->first();
                $user->status = 0;
                $user->save();
                $return['message'] = "Teacher Status successfully";
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


}
