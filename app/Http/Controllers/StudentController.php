<?php

namespace App\Http\Controllers;

use App\Jobs\UsersRegistrationConfirmationMailJob;
use App\Models\Classe;
use App\Models\ClassSubject;
use App\Models\KeyStage;
use App\Models\School;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\StudentSubject;
use App\Models\Subject;
use App\Models\User;
use App\Models\UserGroupMember;
use App\Traits\HasPermission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
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
        $data['page_title'] 	= $this->page_title;
        $data['module_name']	= "Academic";
        $data['sub_module']		= "Students";
        $keyStage =KeyStage::where('status','Active')->get();

        $admin_user_id  		= Auth::user()->id;
        $add_action_id  		= 104; // Student entry
        $add_permission 		= $this->PermissionHasOrNot($admin_user_id,$add_action_id );
        $data['actions']['add_permission']= $add_permission;
        return view('student.index',['keyStages' => $keyStage],$data);
    }

    public function showList()
    {
        $admin_user_id      = Auth::user()->id;
        $edit_action_id     = 105;
        $delete_action_id   = 106;
        $edit_permission    = $this->PermissionHasOrNot($admin_user_id, $edit_action_id);
        $delete_permission  = $this->PermissionHasOrNot($admin_user_id, $delete_action_id);
        $school_ids = Auth::user()->school_id;
        $studentSql = Student::Select('id', 'school_id','student_no','address', 'email', 'contact_no', 'first_name', 'middle_name','last_name','dob','gender', 'parent_name','parent_contact_no','parent_email', 'remarks', 'status');
        $students = $studentSql->where('school_id', $school_ids)->orderBy('created_at', 'desc')->get();
        $return_arr = array();
        foreach ($students as $student) {
            $data['actions'] = "";
            $data['status']             = ($student->status == 'Active') ? "<button class='btn btn-xs btn-success' disabled>Active</button>" : "<button class='btn btn-xs btn-danger' disabled> Inactive </button>";
            //$data['id']                 = $student->id;
            $data['name']               = $student->first_name.' '.$student->middle_name.' '.$student->last_name;
            $data['student_no']         = $student->student_no;
            $data['email']              = $student->email;
            $data['contact_no']         = $student->contact_no;
            $data['actions']		=" <button title='View' onclick='studentView(".$student->id.")' id='view_" . $student->id . "' class='btn btn-xs btn-info btn-hover-shine admin-user-view' ><i class='lnr-eye'></i></button>";
            if($edit_permission>0){
                $data['actions'] 	.=" <button title='Edit' onclick='studentEdit(".$student->id.")' id=edit_" . $student->id . " class='btn btn-xs btn-hover-shine  btn-primary' ><i class='lnr-pencil'></i></button>";
            }
            if ($delete_permission > 0) {
                $data['actions'] .=" <button title='Delete' onclick='studentDelete(".$student->id.")' id='delete_" . $student->id . "' class='btn btn-xs btn-hover-shine btn-danger'><i class='fa fa-trash'></i></button>";
            }

            $return_arr[] = $data;
        }
        return json_encode(array('data' => $return_arr));
    }

    public function createOrEdit(Request $request){

        $admin_user_id      = Auth::user()->id;
        $add_permission     = $this->PermissionHasOrNot($admin_user_id, 104);
        $update_permission  = $this->PermissionHasOrNot($admin_user_id, 105);

        $request->request->add(['type'               => 'Student']);
        $request->request->add(['user_group_type_id' => 4]);

        if(!is_null($request->input('id')) && $request->input('id') != "" && $update_permission){
            $response_data = $this->editStudent($request->all(), $request->input('id'));
        }
        else if($add_permission) {
            $response_data = $this->createStudent($request->all()); // new entry
        } else {
            $return['result'] = 0;
            $return['errors'] = "You are not authorized to insert a Admin";
            $response_data = json_encode($return);
        }
        return $response_data;
    }

    private function createStudent ($request) {

        $adminId    = Auth::user()->school_id;
        $id         = DB::select("SHOW TABLE STATUS LIKE 'students'");
        $next_id    = $id[0]->Auto_increment;
        $studentId  = $adminId.''.date("y").'00'.$next_id;

        try {
            $rule = [
                'address'           => 'Required',
                'email'             => 'Required|email',
                'contact_no'        => 'Required|max:18',
                'first_name'        => 'Required|string',
                'dob'               => 'Required',
                'gender'            => 'Required',
                'parent_name'       => 'Required',
                'parent_contact_no' => 'Required',
            ];
            $validation = Validator::make($request, $rule);

            if ($validation->fails()) {
                return false;
            } else {
                $emailVerification = Student::where('email', $request['email'])->first();
                if(isset($emailVerification->id)){
                    return false;
                }
                DB::beginTransaction();
                $student = Student::create([
                    'school_id'          => Auth::user()->school_id,
                    'student_no'         => $studentId,
                    'address'            => $request['address'],
                    'email'              => $request['email'],
                    'contact_no'         => $request['contact_no'],
                    'first_name'         => $request['first_name'],
                    'middle_name'        => $request['middle_name'],
                    'last_name'          => $request['last_name'],
                    'dob'                => $request['dob'],
                    'gender'             => $request['gender'],
                    'parent_name'        => $request['parent_name'],
                    'parent_contact_no'  => $request['parent_contact_no'],
                    'parent_email'       => $request['parent_email'],
                    'remarks'            => $request['remarks'],
                    'class_id'           => $request['class_id'],
                    'status'             => (isset($request['is_active'])) ? 'Active' : 'Inactive'
                ]);

                $request['typable_id']      = $student->id;
                if(Auth::user()->type == 'School'){
                    $request['school_id']   = Auth::user()->school_id;
                }

                if($student->id){
                    $user = User::createUser($request);
                    // return  $user;
                    if($user==false){
                        throw new \Exception('Student & Student User');
                    }
                    else {
                        StudentClass::create([
                            'student_id'         => $student->id,
                            'class_id'           => $request['class_id'],
                            'status'             => (isset($request['is_active'])) ? 'Active' : 'Inactive'
                        ]);
                        if(isset($request['subject_id'])){
                            foreach($request['subject_id'] as $key => $subjectId) {
                                StudentSubject::create(['class_subject_id' => $subjectId, 'student_id'=>$student->id]);
                            }
                        }
                    }
                } else {
                    throw new \Exception('Student not create!');
                }
                DB::commit();
                $return['result']    = 1;
                $return['message']          = "Student saved successfully";
                return json_encode($return);
            }

        } catch (\Exception $e) {
            DB::rollback();
            $return['result'] = 0;
            $return['message'] = "Failed to save !" . $e->getMessage();
            return json_encode($return);
        }
    }

    private function editStudent($request, $id){
        try {
            if($id == ""){
                return json_encode(array('result'=>0, 'message'=>"Invalid Request!"));
            }

            $student = Student::findOrFail($id);
            if(empty($student)) {
                return json_encode(array('result' => 0, 'message' => "Invalid Request! No School Info Found!"));
            }

            $rule = [
                'address'           => 'Required',
                'email'             => 'Required|email',
                'contact_no'        => 'Required|max:18',
                'first_name'        => 'Required|string',
                'dob'               => 'Required',
                'gender'            => 'Required',
                'parent_name'       => 'Required',
                'parent_contact_no' => 'Required',
            ];

            $validation = Validator::make($request, $rule);
            if ($validation->fails()) {
                return false;
            } else {
                DB::beginTransaction();
                $status = (isset($request['is_active']))?'Active':'Inactive';
                $student->address            = $request['address'];
                $student->email              = $request['email'];
                $student->contact_no         = $request['contact_no'];
                $student->first_name         = $request['first_name'];
                $student->middle_name        = $request['middle_name'];
                $student->last_name          = $request['last_name'];
                $student->dob                = $request['dob'];
                $student->gender             = $request['gender'];
                $student->parent_name        = $request['parent_name'];
                $student->parent_contact_no  = $request['parent_contact_no'];
                $student->parent_email       = $request['parent_email'];
                $student->remarks            = $request['remarks'];
                $student->class_id           = $request['class_id'];
                $student->status             = (isset($request['is_active'])) ? 'Active' : 'Inactive';
                $student->update();

                $userTypeId = User::where('typable_id', $student->id)->first();
                $request['password'] = "";
                $userId = $userTypeId->id;
                if($student->id){
                $user = User::editUser($request, $userId);
                    if($user==false){
                        throw new \Exception('Student & Student User');
                    }else {
                        $stuClass = StudentClass::where('student_id', $student->id)->where('status','Active')->first();
                        if($stuClass->class_id == $request['class_id']){
                            $stuClass->student_id   = $student->id;
                            $stuClass->class_id     = $request['class_id'];
                            $stuClass->status       = (isset($request['is_active'])) ? 'Active' : 'Inactive';
                            $stuClass->update();
                        }else {
                            StudentClass::where('student_id', $student->id)->update(['status' => 'Inactive']);
                                StudentClass::create([
                                    'student_id'         => $student->id,
                                    'class_id'           => $request['class_id'],
                                    'status'             => (isset($request['is_active'])) ? 'Active' : 'Inactive'
                                ]);
                        }
                        foreach ($request['subject_id'] as $key => $subjectID) {
                            $studentSubject[$subjectID] = ['class_subject_id' => $request['subject_id']];
                        }
                        $student = Student::find($id);
                        $student->student_subjects()->sync($studentSubject[$subjectID]['class_subject_id']);
                    }
                } else {
                    throw new \Exception("Student Not Create!");
                }

                // if status changed to active or inactive
                if($student->status != $status) {
                    $user           = User::where('typable_id', '=', $student->id)->first();
                    $user->status   = ($status == 'Active') ? 1 : 0;
                    $user->update();
                }

                DB::commit();
                $return['result'] = 1;
                $return['message'] = "Student Updated successfully";
                return json_encode($return);
            }
        } catch (\Exception $e) {
            DB::rollback();
            $return['result'] = 0;
            $return['message'] = "Failed to update !" . $e->getMessage();
            return json_encode($return);
        }
    }

    public function show($id)
    {
        if ($id == "") return 0;
        $student = Student::with('classes.KeyStages')->findOrFail($id);
        foreach ($student->classes as $classid);
        $classSubject = ClassSubject::where('class_id',$classid->id)->get();
        dd($classSubject);
        $user = User::where('typable_id', $id)->first();
        return json_encode(array('student' => $student, 'user'=>$user));
    }

    public function destroy($id){
        if ($id == "") {
            return json_encode(array('result' => 0, 'message' => "Invalid Request! "));
        }

        $student = Student::with('users')->findOrFail($id);
        $is_deletable = (count($student->users)==0)?1:0;

        try {
            DB::beginTransaction();
            if($is_deletable){
                $user = User::with('user_groups')->where('typable_id','=',$id)->first();
                UserGroupMember::where('user_id','=',$user->id)->delete();
                $user->delete();
                $student->delete();
                $return['message'] = "Student Deleted successfully";
            }
            else {
                $student->status = 'Inactive';
                $student->update();

                $user = User::where('typable_id', '=', $id)->first();
                $user->status = 0;
                $user->save();
                $return['message'] = "Student Status successfully";
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

    public function getStageClass(Request $request){
        if($request['key_stage_id']){
            $classe = Classe::where('key_stage_id',$request['key_stage_id'])->get();
        }
        return json_encode(array('classe' => $classe));
    }

    public function getClassSubject(Request $request){
        if($request['class_id']){
            $classSubject = ClassSubject::with('subjects')->where('class_id',$request['class_id'])->get();
        }

        return json_encode(array('classSubject' => $classSubject));
    }
}
