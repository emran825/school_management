<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\ClassSubject;
use App\Models\KeyStage;
use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Topic;
use App\Traits\HasPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    use HasPermission;

    public function __construct(Request $request)
    {
        $this->page_title   = $request->route()->getName();
        $description        = \Request::route()->getAction();
        $this->page_desc    = isset($description['desc']) ? $description['desc'] : $this->page_title;
    }

    public function index(){
        $data['page_title'] 	= $this->page_title;
        $data['module_name']	= "Quiz";
        $data['sub_module']		= "Quizes";
        $keyStage =KeyStage::where('status','Active')->get();

        $admin_user_id  		= Auth::user()->id;
        $add_action_id  		= 132;
        $add_permission 		= $this->PermissionHasOrNot($admin_user_id,$add_action_id );
        $data['actions']['add_permission']= $add_permission;
        return view('quiz.index',['keyStages' => $keyStage,], $data);
    }

    public function showList(){
        $admin_user_id 		= Auth::user()->id;
        $edit_action_id 	= 133;
        $delete_action_id 	= 134;
        $edit_permission 	= $this->PermissionHasOrNot($admin_user_id,$edit_action_id);
        $delete_permission 	= $this->PermissionHasOrNot($admin_user_id,$delete_action_id);

        $quizes = Quiz::with('subjects','classes.keyStages','topices')->get();
        $return_arr = array();
        foreach($quizes as $quiz){
            $data['status'] 	    = ($quiz->status == 'Active')?"<button class='btn btn-xs btn-success' disabled>Active</button>":"<button class='btn btn-xs btn-danger' disabled>Inactive</button>";
            $data['title'] 		    = $quiz->title;
            $data['year_name'] 		= $quiz->classes->keyStages->name;
            $data['class_name']     = $quiz->classes->name;
            $data['subject_name'] 	= $quiz->subjects->subject_name;
            $data['topic_name']     = $quiz->topices->topic_name;
            $data['total_student']  = 50;
            $data['total_question'] = 20;
            $data['actions'] =" <button title='View' onclick='quizView(".$quiz->id.")' id='view_" . $quiz->id . "' class='btn btn-xs btn-info admin-user-view'><i class='lnr-eye'></i></button>&nbsp;";
            if($edit_permission>0){
                $data['actions'] .="<button onclick='quizEdit(".$quiz->id.")' id=edit_" . $quiz->id . "  class='btn btn-xs btn-primary module-edit'><i class='lnr-pencil'></i></button>";
                $data['actions'] .="<button onclick='quizAdd(".$quiz->id.")' id=add_" . $quiz->id . "  class='btn btn-xs btn-success module-add ml-1'><i class='fa fa-plus'></i></button>";
            }
            if ($delete_permission>0) {
                $data['actions'] .=" <button onclick='quizDelete(".$quiz->id.")' id='delete_" . $quiz->id . "' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button>";
            }
            $return_arr[] = $data;
        }
        return json_encode(array('data'=>$return_arr));
    }

    public function quizCreateOrEdit(Request $request){
        $admin_user_id      = Auth::user()->id;
        $add_permission     = $this->PermissionHasOrNot($admin_user_id, 132);
        $update_permission  = $this->PermissionHasOrNot($admin_user_id, 133);

        if(!is_null($request->input('edit_id')) && $request->input('edit_id') != "" && $update_permission){
            $response_data = $this->editQuiz($request->all(), $request->input('edit_id'));
        }
        else if($add_permission) {
            $response_data = $this->createQuiz($request->all()); // new entry
        } else {
            $return['result'] = 0;
            $return['errors'] = "You are not authorized to insert a Admin";
            $response_data = json_encode($return);
        }
        return $response_data;
    }

    private function createQuiz ($request) {
        $schoolID = Auth::user()->school_id;
        try {
            $rule = [
                'title'             => 'Required',
                'year_id'           => 'Required',
                'class_id'          => 'Required|max:18',
                'subject_id'        => 'Required|string',
                'topic_id'          => 'Required',
            ];
            $validation = Validator::make($request, $rule);
            if ($validation->fails()) {
                $return['result'] = 0;
                $return['message'] = "Failed to save !";
                return json_encode($return);
            } else {

                DB::beginTransaction();
                Quiz::create([
                    'school_id'             => $schoolID,
                    'year_id'               => $request['year_id'],
                    'class_id'              => $request['class_id'],
                    'subject_id'            => $request['subject_id'],
                    'topic_id'              => $request['topic_id'],
                    'title'                 => $request['title'],
                    'instruction'           => $request['instruction'],
                    'attachment'            => $request['attachment'],
                    'remote_media_file_link'=> $request['remote_media_file_link'],
                    'status'                => (isset($request['is_active'])) ? 'Active' : 'Inactive'
                ]);

                DB::commit();
                $return['result']    = 1;
                $return['message']          = "Quiz saved successfully";
                return json_encode($return);
            }

        } catch (\Exception $e) {
            DB::rollback();
            $return['result'] = 0;
            $return['message'] = "Failed to save !" . $e->getMessage();
            return json_encode($return);
        }
    }

    private function editQuiz($request, $id){
        try {
            if ($id == "") {
                throw new \Exception('Invalid request!');
            }
            $quiz = Quiz::findOrFail($id);
            $rule = [
                'title'             => 'Required',
                'year_id'           => 'Required',
                'class_id'          => 'Required|max:18',
                'subject_id'        => 'Required|string',
                'topic_id'          => 'Required',
            ];
            $validation = Validator::make($request, $rule);
            if ($validation->fails()) {
                $return['result'] = 0;
                $return['message'] = "Failed to save !";
                return json_encode($return);
            } else {

                DB::beginTransaction();
                $quiz->school_id                = Auth::user()->school_id;
                $quiz->year_id                  = $request['year_id'];
                $quiz->class_id                 = $request['class_id'];
                $quiz->subject_id               = $request['subject_id'];
                $quiz->topic_id                 = $request['topic_id'];
                $quiz->title                    = $request['title'];
                $quiz->instruction              = $request['instruction'];
                $quiz->attachment               = $request['attachment'];
                $quiz->remote_media_file_link   = $request['remote_media_file_link'];
                $quiz->status                   = (isset($request['is_active'])) ? 'Active' : 'Inactive';
                $quiz->update();

                DB::commit();
                $return['result']       = 1;
                $return['message']      = "Quiz Update successfully";
                return json_encode($return);
            }

        } catch (\Exception $e) {
            DB::rollback();
            $return['result']   = 0;
            $return['message']  = "Failed to save !" . $e->getMessage();
            return json_encode($return);
        }
    }

    public function show($id)
    {
        if ($id == "") return 0;
        $quiz       = Quiz::with('subjects','classes.keyStages','topices')->findOrFail($id);
        $question   = Question::with('options')->where('quiz_id', $quiz->id)->get();
        $keyStage   = KeyStage::all(); // all keystage
        $years      = Classe::where('key_stage_id',$quiz->class_id)->get();// all years of the quize's keystage =1
        $subjects   = ClassSubject::with('subjects')->where('class_id',$quiz->class_id)->get();
        $topics     = Topic::where('subject_id',$quiz->subject_id)->get();
        return json_encode(array('quiz' => $quiz, 'years' => $years, 'subjects' => $subjects, 'topics' => $topics, 'questions' => $question));
    }

    public function destroy($id){
        if ($id == "") {
            return json_encode(array('result' => 0, 'message' => "Invalid Request! "));
        }
        $quiz = Quiz::findOrFail($id);
        try {
            DB::beginTransaction();
                $quiz->status = 'Inactive';
                $quiz->update();
                $return['message'] = "Deletation is not possible, but Inactive the Quiz";

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

    public function getClassSubjectTopic(Request $request){
        if($request['class_subject_topic_id']){
            $topics     = Topic::where('subject_id',$request['class_subject_topic_id'])->get();
        }
        return json_encode(array('topics' => $topics));
    }

    public function questionCreateOrEdit(Request $request){
        $admin_user_id      = Auth::user()->id;
        $add_permission     = $this->PermissionHasOrNot($admin_user_id, 132);
        $update_permission  = $this->PermissionHasOrNot($admin_user_id, 133);

        if(!is_null($request->input('edit_id')) && $request->input('edit_id') != "" && $update_permission){
            $response_data = $this->editQestion($request->all(), $request->input('edit_id'));
        }
        else if($add_permission) {
            $response_data = $this->createQestion($request->all()); // new entry
        } else {
            $return['result'] = 0;
            $return['errors'] = "You are not authorized to insert a Admin";
            $response_data = json_encode($return);
        }
        return $response_data;
    }

    private function createQestion ($request) {
        try {
            $rule = [
                'question_detail'   => 'Required',
                'mark'              => 'Required',
            ];

            $validation = Validator::make($request, $rule);
            if ($validation->fails()) {
                $return['result'] = 0;
                $return['message'] = "Failed to save !";
                return json_encode($return);
            } else {
                DB::beginTransaction();
                $question = Question::create([
                    'quiz_id'               => $request['quiz_id'],
                    'question_detail'       => $request['question_detail'],
                    'mark'                  => $request['mark'],
                    'type'                  => $request['type'],
                    'audio'                 => $request['audio'],
                    'serial'                => 1,
                    'status'                => (isset($request['is_active'])) ? 'Active' : 'Inactive'
                ]);
                $photo = (isset($request['image']) && $request['image']!= "")?$request['image']:"";
                if ($photo!="") {
                    $ext                    = $photo->getClientOriginalExtension();
                    $photoFullName          = time().$photo->getClientOriginalName();
                    $uploadPath             = 'assets/images/question/';
                    $success                = $photo->move($uploadPath, $photoFullName);
                    $question->image        = $photoFullName;
                    $question->save();
                }
                if($question->id) {

                    Option::quiztionOptions($request, $question->id);
                } else { throw new \Exception('Question information Not Found!'); }
                DB::commit();
                $return['result']    = 1;
                $return['message']   = "Question saved successfully";
                return json_encode($return);
            }

        } catch (\Exception $e) {
            DB::rollback();
            $return['result']   = 0;
            $return['message']  = "Failed to save !" . $e->getMessage();
            return json_encode($return);
        }
    }

    private function editQestion($request, $id){

    }


}
