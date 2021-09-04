<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\Classe;
use App\Models\ClassYear;
use App\Models\StudentClass;
use App\Models\Subject;
use App\Models\Year;
use App\Traits\HasPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClassController extends Controller
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
        $data['module_name']	= "Class";
        $data['sub_module']		= "Classe";
        $admin_user_id  		= Auth::user()->id;
        $add_action_id  		= 116;
        $add_permission 		= $this->PermissionHasOrNot($admin_user_id,$add_action_id );
        $data['actions']['add_permission']= $add_permission;
        return view('class.index', $data);
    }

    public function classSubjectCreateOrEdit(Request $request){
        $admin_user_id      = Auth::user()->id;
        $add_permission     = $this->PermissionHasOrNot($admin_user_id, 116);
        $update_permission  = $this->PermissionHasOrNot($admin_user_id, 117);

        if(!is_null($request->input('id')) && $request->input('id') != "" && $update_permission){
            $response_data = $this->editClassSubject($request->all(), $request->input('id'));
        } else if ($add_permission) {
            $response_data = $this->createClassSubject($request->all()); // new entry
        } else {
            $return['result'] = 0;
            $return['errors'] = "You are not authorized to insert a Admin";
            $response_data = json_encode($return);
        }
        return $response_data;
    }

    private function createClassSubject($request)
    {
        try {
            $rule = [ 'class_id' => 'required|string', ];

            $validation = Validator::make($request, $rule);
            if ($validation->fails()) {
                throw new \Exception('Class Not Found');
            } else {
                DB::beginTransaction();
                if(isset($request['subject_id'])){
                    foreach($request['subject_id'] as $key => $subjectId) {
                        ClassSubject::create(['subject_id' => $subjectId, 'class_id'=>$request['class_id']]);
                    }
                }
                DB::commit();
                $return['result']    = 1;
                $return['message']   = "Save Subject Class Assign";
                return json_encode($return);
            }

        } catch (\Exception $e) {
            DB::rollback();
            $return['result'] = 0;
            $return['message'] = "Failed to save !" . $e->getMessage();
            return json_encode($return);
        }
    }

    private function editClassSubject($request, $id){

        try {
            $rule = ['class_id' => 'required|string'];
            $validation = Validator::make($request, $rule);
            if ($validation->fails()) {
                throw new \Exception('Class Not Found');
            } else {
                DB::beginTransaction();
                    foreach($request['subject_id'] as $key => $subjectId) {
                        $classSubject[$subjectId] =  ['subject_id' => $request['subject_id']];
                    }
                    $class = Classe::find($id);
                    $class->subjects()->sync($classSubject[$subjectId]['subject_id']);
                DB::commit();
                $return['result']    = 1;
                $return['message']   = "Save Subject Class Assign Data";
                return json_encode($return);
            }

        } catch (\Exception $e) {
            DB::rollback();
            $return['result'] = 0;
            $return['message'] = "Failed to save !" . $e->getMessage();
            return json_encode($return);
        }
    }

    public function showList()
    {
        $admin_user_id      = Auth::user()->id;
        $edit_action_id     = 117;
        $edit_permission    = $this->PermissionHasOrNot($admin_user_id, $edit_action_id);
        $add_permission     = $this->PermissionHasOrNot($admin_user_id, 116);

        $classKeyStage = Classe::Select('id', 'name', 'details', 'key_stage_id', 'status')->with('KeyStages')->orderBy('created_at', 'desc')->get();

        foreach ($classKeyStage as $classKey) {
            $data['class_group']          = $classKey->KeyStages->class_group;
            $data['key_stage_name']       = $classKey->KeyStages->name;
            $data['class_name']           = $classKey->name;
            $data['class_details']        = $classKey->details;

            if ($edit_permission > 0) {
                    $data['actions']  = "<button onclick='classSubjectView(" . $classKey->id . ")' id=edit_" . $classKey->id . "  class='btn btn-xs btn-hover-shine  btn-info module-edit'><i class='lnr-eye'></i></button>";
            }
            if ($edit_permission > 0) {
                $data['actions']     .= " <button onclick='classSubjectEdit(" . $classKey->id . ")' id='edit_" . $classKey->id . "' class='btn btn-xs btn-hover-shine btn-primary' ><i class='lnr-pencil'></i></button>";
                $data['actions']     .= " <button onclick='classSubjectAdd(" . $classKey->id . ")' id='edit_" . $classKey->id . "' class='btn btn-xs btn-hover-shine btn-success' ><i class='lnr-plus-circle'></i></button>";
            }
            $return_arr[] = $data;
        }

        return json_encode(array('data' => $return_arr));
    }

    public function classKeyStage($id){
        if ($id == "") return 0;
        $class = Classe::with('KeyStages')->findOrFail($id);
        return json_encode(array('classes' => $class));
    }

    public function showClassSubject($id){
        if ($id == "") return 0;
        $classe = Classe::with('subjects','keystages')->findOrFail($id);
        return json_encode(array('classe' => $classe));
    }

    public function keyStageClassSubjectAutoComplete(){

        $term = $_REQUEST['term'];
        $data = Subject::with('classes','keystages')
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
                foreach($row['classes'] as $rows){
                    $json[] = array('id' => $rows['pivot']['id'],'label' => $rows["keystages"]["name"]." -> ".$rows["name"]." -> ".$row["subject_name"]);
                }
            }
        }
        else {
            $json[] = array('id' => "0",'label' => "Not Found !!!");
        }
        return json_encode($json);
    }
}
