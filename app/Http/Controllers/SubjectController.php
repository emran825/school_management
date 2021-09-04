<?php

namespace App\Http\Controllers;

use App\Jobs\UsersRegistrationConfirmationMailJob;
use App\Mail\SchoolUser;
use App\Mail\TestMail;
use App\Mail\UsersRegistrationConfirmationMail;
use App\Models\ClassSubject;
use App\Models\School;
use App\Models\Subject;
use App\Models\Topic;
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



class SubjectController extends Controller
{
    use HasPermission;
    public function __construct(Request $request)
    {
        $this->page_title   = $request->route()->getName();
        $description        = \Request::route()->getAction();
        $this->page_desc    = isset($description['desc']) ? $description['desc'] : $this->page_title;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title']     = $this->page_title;
        $data['module_name']    = "Academic";
        $data['sub_module']        = "Subject";
        $data['subject'] = 0;

        $admin_user_id          = Auth::user()->id;
        $add_action_id          = 113;
        $add_permission         = $this->PermissionHasOrNot($admin_user_id, $add_action_id);
        $data['actions']['add_permission'] = $add_permission;
        return view('subject.subject', $data);
    }

    public function createOrEdit(Request $request)
    {
        $admin_user_id         = Auth::user()->id;
        $userType             = Auth::user()->type;
        $entry_permission     = $this->PermissionHasOrNot($admin_user_id, 113);
        $update_permission     = $this->PermissionHasOrNot($admin_user_id, 115);

        // update
        if (!is_null($request->input('edit_id')) && $request->input('edit_id') != "" && $update_permission) {

            $response_data =  $this->editSubject($request->all(), $request->input('edit_id'));
        }
        // new entry
        else if ($entry_permission) {
            $response_data =  $this->createSubject($request->all());
        } else {
            $return['response_code'] = 0;
            $return['errors'] = "You are not authorized to insert a Subject";
            $response_data = json_encode($return);
        }
        return $response_data;
    }

    private function createSubject($request)
    {
        $centerId = Auth::user()->center_id;
        try {
            $rule = [
                'subject_name'            => 'required',
            ];

            $validation = \Validator::make($request, $rule);
            if ($validation->fails()) {
                $return['response_code'] = "0";
                $return['errors'] = $validation->errors();
                return json_encode($return);
            } else {
                DB::beginTransaction();
                $subject = Subject::create([
                    'subject_name' =>  $request['subject_name'],
                    'subject_details' =>  $request['subject_details'],
                    'status'     => (isset($request['status'])) ? 'Active' : 'Inactive'
                ]);
                /*-----------New Code For Subject Topic Add Start--------------*/

                if (isset($request['topic_name'])) {

                    foreach ($request['topic_name'] as $k => $topic_name) {

                        Topic::create([
                            'topic_name'     => $topic_name,
                            'topic_details'    =>  $request['topic_details'][$k],
                            'status' =>  $request['status'][$k],
                            'subject_id' => $subject->id,
                        ]);
                    }
                }
                /*-----------New Code For Subject Topic Add End --------------*/

                DB::commit();
                $return['response_code'] = 1;
                $return['message'] = "Subject saved successfully";
                return json_encode($return);
            }
        } catch (\Exception $e) {
            DB::rollback();
            $return['response_code']     = 0;
            $return['errors'] = "Failed to save !" . $e->getMessage();
            return json_encode($return);
        }
    }

    private function editSubject($request, $id)
    {

        try {
            if ($id == "") { return json_encode(array('response_code' => 0, 'errors' => "Invalid request! ")); }

            $subject = Subject::findOrFail($id);
            if (empty($subject)) {
                return json_encode(array('response_code' => 0, 'errors' => "Invalid request! No Subject found"));
            }

            $rule = [
                'subject_name'            => 'required',
            ];

            $validation = \Validator::make($request, $rule);
            if ($validation->fails()) {
                $return['result'] = "0";
                $return['errors'] = $validation->errors();
                return json_encode($return);
            } else {
                DB::beginTransaction();
                $subject->subject_name     = $request['subject_name'];
                $subject->subject_details     = $request['subject_details'];
                $subject->status         =  (isset($request['status'])) ? "Active" : 'Inactive';
                $subject->update();

                /*-------------------Topic Update Start------------------*/
                if (isset($request['topic_id']) && !empty($request['topic_id'])) {
                    foreach ($request['topic_id'] as $k => $topic_id) {
                        if (!is_null($topic_id)) {
                            $topic = Topic::where('id', $topic_id)->first();
                            $topic->topic_name        = $request['topic_name'][$k];
                            $topic->topic_details     = $request['topic_details'][$k];
                            $topic->subject_id = $subject->id;
                            $topic->status  = $request['status'][$k];
                            $topic->update();
                        } else {
                            Topic::create([
                                'topic_name'     => $request['topic_name'][$k],
                                'topic_details'    =>  $request['topic_details'][$k],
                                'status' =>  $request['status'][$k],
                                'subject_id' => $subject->id,
                            ]);
                        }
                    }
                }
                /*------------------Topic Update End --------------------*/
                DB::commit();
                $return['response_code'] = 1;
                $return['message'] = "Subject Updated successfully";
                return json_encode($return);
            }
        } catch (\Exception $e) {
            DB::rollback();
            $return['response_code']     = 0;
            $return['errors'] = "Failed to update !" . $e->getMessage();
            return json_encode($return);
        }
    }

    public function show($id)
    {
        if ($id == "") return 0;
        $subject = Subject::findOrFail($id);
        $subject = Subject::with('topics')->findOrFail($id);
        $topic = DB::table('topics')
            ->where('subject_id', $id)
            ->get();
        return json_encode(array('subject' => $subject, 'topic' => $topic));
    }

    public function showSubject($id){
        if ($id == "") return 0;
        $subject = Subject::with('classes','keystages')->findOrFail($id);
        return json_encode(array('subject' => $subject));
    }

    public function showClassSubject($id){
        if ($id == "") return 0;
        $classSubject = ClassSubject::with('subjects','classes','classes.KeyStages')->findOrFail($id);
        return json_encode(array('subjectclass' => $classSubject));
    }

    public function showList()
    {
        $admin_user_id       = Auth::user()->id;
        $userType            = Auth::user()->type;
        $edit_action_id      = 115; //  edit
        $delete_action_id    = 114; //  delete
        $edit_permisiion     = $this->PermissionHasOrNot($admin_user_id, $edit_action_id);
        $delete_permisiion   = $this->PermissionHasOrNot($admin_user_id, $delete_action_id);

        $subjects     = Subject::orderBy('created_at', 'desc')->get();
        $return_arr = array();
        foreach ($subjects as $subject) {
            $data['actions']    = "";
            $data['status']     = ($subject->status == 'Active') ? "<button class='btn btn-xs btn-success' disabled>Active</button>" : "<button class='btn btn-xs btn-danger' disabled>Inactive</button>";
            $data['subject_name']         = $subject->subject_name;
            $data['subject_details']         = $subject->subject_details;
            $data['actions']    = "<button title='View' onclick='subjectView(" . $subject->id . ")' id='view_" . $subject->id . "' class='btn btn-xs btn-primary' ><i class='lnr-eye'></i></button>&nbsp;";
            if ($edit_permisiion > 0) {
                $data['actions'] .= "<button onclick='subjectEdit(" . $subject->id . ")' id=edit_" . $subject->id . " class='btn btn-xs btn-hover-shine  btn-primary' ><i class='lnr-pencil'></i></button>";
            }
            if ($delete_permisiion > 0) {
                $data['actions'] .= " <button onclick='subjectDelete(" . $subject->id . ")' id='delete_" . $subject->id . "' class='btn btn-xs btn-danger' ><i class='fa fa-trash'></i></button>";
            }
            $return_arr[] = $data;
        }
        return json_encode(array('data' => $return_arr));
    }

    public function destroy($id)
    {
        if ($id == "") {
            return json_encode(array('response_code' => 0, 'errors' => "Invalid request! "));
        }

        $subject_topic = Subject::with('topics')->findOrFail($id);
        $is_deletable = (count($subject_topic->topics) == 0) ? 1 : 0; // 1:deletabe, 0:not-deletable
        if (empty($subject_topic)) {
            return json_encode(array('response_code' => 0, 'errors' => "Invalid request! No Batch found"));
        }

        try {
            DB::beginTransaction();
            if ($is_deletable) {
                Topic::where('subject_id', $subject_topic->id)->delete();
                $subject_topic->delete();
                $return['message'] = "Subject Deleted successfully";
            } else {
                $subject_topic->status = 'Inactive';
                $subject_topic->update();
                $return['message'] = "Deletation is not possible, but Inactive the Subject";
            }
            DB::commit();
            $return['response_code'] = 1;
            return json_encode($return);

        }  catch (\Exception $e) {
            DB::rollback();
            $return['response_code']     = 0;
            $return['errors'] = "Failed to delete !" . $e->getMessage();
            return json_encode($return);
        }
    }

    function  subjectAutoComplete(){
        $term = $_REQUEST['term'];
        $data = Subject::select('id', 'subject_name', 'subject_details')
            ->where([
                ['status', '=', 'Active'],
                ['subject_name','like','%'.$term.'%']
            ])
            ->orwhere([
                ['status', '=', 'Active'],
                ['subject_details','like','%'.$term.'%']
            ])
            ->get();
        $data_count = $data->count();

        if($data_count>0){
            foreach ($data as $row) {
                $json[] = array('id' => $row["id"],'label' => $row["subject_name"]." -> ".$row["subject_details"]);
            }
        }
        else {
            $json[] = array('id' => "0",'label' => "Not Found !!!");
        }
        return json_encode($json);

    }
}




