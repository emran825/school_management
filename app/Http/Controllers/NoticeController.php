<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\NoticeCategory;
use App\Traits\HasPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class NoticeController extends Controller
{
    use HasPermission;
    public function __construct(Request $request)
    {
        $this->page_title   = $request->route()->getName();
        $description        = \Request::route()->getAction();
        $this->page_desc    = isset($description['desc']) ? $description['desc'] : $this->page_title;
    }

    /*---------------------------NOTICE CATEGORY CONTROLLER FUNCTION START--------------------------- */
    public function index()
    {
        $data['page_title']                 = $this->page_title;
        $data['module_name']                = "Settings";
        $data['sub_module']                 = "Notice Category";

        $admin_user_id                      = Auth::user()->id;
        $add_action_id                      = 124;
        $add_permission                     = $this->PermissionHasOrNot($admin_user_id, $add_action_id);
        $data['actions']['add_permission']  = $add_permission;
        return view('notice.notice_category', $data);
    }

    public function noticeCategoryCreateOrEdit(Request $request)
    {
        $admin_user_id         = Auth::user()->id;
        $entry_permission      = $this->PermissionHasOrNot($admin_user_id, 124);
        $update_permission     = $this->PermissionHasOrNot($admin_user_id, 126);
        // update
        if (!is_null($request->input('edit_id')) && $request->input('edit_id') != "" && $update_permission) {
            $response_data =  $this->editNoticeCategory($request->all(), $request->input('edit_id'));
        }
        // new entry
        else if ($entry_permission) {
            $response_data =  $this->createNoticeCategory($request->all());
        } else {
            $return['result'] = 0;
            $return['message'] = "You are not authorized to insert a Subject";
            $response_data = json_encode($return);
        }
        return $response_data;
    }

    private function createNoticeCategory($request)
    {
        try {
            $rule = [
                'category_name'      => 'required',
                'details'            => 'required',
            ];

            $validation = \Validator::make($request, $rule);
            if ($validation->fails()) {
                $return['result'] = "0";
                $return['message'] = $validation->errors();
                return json_encode($return);
            } else {
                DB::beginTransaction();
                $subject            = NoticeCategory::create([
                    'category_name' =>  $request['category_name'],
                    'details'       =>  $request['details'],
                    'status'        => (isset($request['status'])) ? 'Active' : 'Inactive'
                ]);

                DB::commit();
                $return['result'] = 1;
                $return['message'] = "Notice Category saved successfully";
                return json_encode($return);
            }
        } catch (\Exception $e) {
            DB::rollback();
            $return['result']     = 0;
            $return['message'] = "Failed to save !" . $e->getMessage();
            return json_encode($return);
        }
    }

    private function editNoticeCategory($request, $id)
    {
        try {
            if ($id == "") {
                throw new \Exception('Invalid request!');
            }
            $noticecategory = NoticeCategory::findOrFail($id);
            if (empty($noticecategory)) {
                throw new \Exception('Invalid request! No Category found');
            }
            $rule = [
                'category_name'      => 'required',
                'details'            => 'required',
            ];

            $validation = \Validator::make($request, $rule);
            if ($validation->fails()) {
                $return['result'] = "0";
                $return['message'] = $validation->errors();
                return json_encode($return);
            } else {
                DB::beginTransaction();
                $noticecategory->category_name     = $request['category_name'];
                $noticecategory->details           = $request['details'];
                $noticecategory->status            =  (isset($request['status'])) ? "Active" : 'Inactive';
                $noticecategory->update();

                DB::commit();
                $return['result'] = 1;
                $return['message'] = "Notice Category Updated successfully";
                return json_encode($return);
            }
        } catch (\Exception $e) {
            DB::rollback();
            $return['result']     = 0;
            $return['message'] = "Failed to update !" . $e->getMessage();
            return json_encode($return);
        }
    }

    public function showList()
    {
        $admin_user_id       = Auth::user()->id;
        $userType            = Auth::user()->type;
        $edit_action_id      = 126; //  edit
        $delete_action_id    = 125; //  delete
        $edit_permission     = $this->PermissionHasOrNot($admin_user_id, $edit_action_id);
        $delete_permission   = $this->PermissionHasOrNot($admin_user_id, $delete_action_id);

        $notice_categoryes     = NoticeCategory::orderBy('created_at', 'desc')->get();
        $return_arr = array();
        foreach ($notice_categoryes as $notice_category) {
            $data['actions']    = "";
            $data['status']     = ($notice_category->status == 'Active') ? "<button class='btn btn-xs btn-success' disabled>Active</button>" : "<button class='btn btn-xs btn-danger' disabled>Inactive</button>";
            $data['category_name']         = $notice_category->category_name;
            $data['details']         = $notice_category->details;
            $data['actions']    = "<button title='View' onclick='notice_category_view(" . $notice_category->id . ")' id='view_" . $notice_category->id . "' class='btn btn-xs btn-primary' ><i class='lnr-eye'></i></button>&nbsp;";
            if ($edit_permission > 0) {
                $data['actions'] .= "<button onclick='notice_category_edit(" . $notice_category->id . ")' id=edit_" . $notice_category->id . " class='btn btn-xs btn-hover-shine  btn-primary' ><i class='lnr-pencil'></i></button>";
            }
            if ($delete_permission > 0) {
                $data['actions'] .= " <button onclick='notice_category_delete(" . $notice_category->id . ")' id='delete_" . $notice_category->id . "' class='btn btn-xs btn-danger' ><i class='fa fa-trash'></i></button>";
            }
            $return_arr[] = $data;
        }
        return json_encode(array('data' => $return_arr));
    }

    public function destroy($id)
    {
        if ($id == "") {
            throw new \Exception('Invalid request!');
        }
        $noticeCategory = NoticeCategory::with('notice')->findOrFail($id);
        $is_deletable = (count($noticeCategory->notice) == 0) ? 1 : 0; // 1:deletabe, 0:not-deletable
        if (empty($noticeCategory)) {
            throw new \Exception('Invalid request! No Notice Category found');
        }

        try {
            DB::beginTransaction();
            if ($is_deletable) {
                $noticeCategory->delete();
                $return['message'] = "Notice Category Deleted successfully";
            } else {
                $noticeCategory->status     = 'Inactive';
                $noticeCategory->update();
                $return['message']          = "Deletation is not possible, but deactivated the Notice Category";
            }
            DB::commit();
            $return['result']   = 1;
            $return['message']  = "Deletation is not possible, but deactivated the unit";
            return json_encode($return);
        } catch (\Exception $e) {
            DB::rollback();
            $return['result']    = 0;
            $return['message']           = "Failed to delete !" . $e->getMessage();
            return json_encode($return);
        }
    }

    public function show($id)
    {
        if ($id == "") return 0;
        $noticeCategory = NoticeCategory::findOrFail($id);
        return json_encode(array('noticeCategory' => $noticeCategory));
    }
    /*---------------------------NOTICE CATEGORY CONTROLLER FUNCTION END--------------------------- */

    /*---------------------------NOTICE CONTROLLER FUNCTION START---------------------------------- */
    public function noticeIndex()
    {
        $data['page_title']                 = $this->page_title;
        $data['module_name']                = "Notification & Notice";
        $data['sub_module']                 = "Notice";
        $data['noticeCategories']           = NoticeCategory::where('status', 'Active')->get();
        $admin_user_id                      = Auth::user()->id;
        $add_action_id                      = 121;
        $add_permission                     = $this->PermissionHasOrNot($admin_user_id, $add_action_id);
        $data['actions']['add_permission']  = $add_permission;
        return view('notice.notice', $data);
    }

    public function noticeShowList()
    {
        $admin_user_id       = Auth::user()->id;
        $edit_action_id      = 122; //  edit
        $delete_action_id    = 120; //  delete
        $edit_permission     = $this->PermissionHasOrNot($admin_user_id, $edit_action_id);
        $delete_permission   = $this->PermissionHasOrNot($admin_user_id, $delete_action_id);

        $notices     = Notice::orderBy('created_at', 'desc')->get();
        $return_arr = array();

        foreach ($notices as $notice) {
            $data['actions']                = "";
            $data['status']                 = ($notice->status == 'Active') ? "<button class='btn btn-xs btn-success' disabled>Active</button>" : "<button class='btn btn-xs btn-danger' disabled>Inactive</button>";
            $data['title']                  = $notice->title;
            $data['notice_category_id']     = $notice->notice_category->category_name;
            $data['notice_date']            = $notice->notice_date;
            $data['expire_date']            = $notice->expire_date;
            $data['actions']                = "<button title='View' onclick='noticeView(" . $notice->id . ")' id='view_" . $notice->id . "' class='btn btn-xs btn-primary' ><i class='lnr-eye'></i></button>&nbsp;";
            if ($edit_permission > 0) {
                $data['actions']            .= "<button onclick='noticeEdit(" . $notice->id . ")' id=edit_" . $notice->id . " class='btn btn-xs btn-hover-shine  btn-primary' ><i class='lnr-pencil'></i></button>";
            }
            if ($delete_permission > 0) {
                $data['actions']            .= " <button onclick='notice_delete(" . $notice->id . ")' id='delete_" . $notice->id . "' class='btn btn-xs btn-danger' ><i class='fa fa-trash'></i></button>";
            }
            $return_arr[] = $data;
        }

        return json_encode(array('data' => $return_arr));
    }

    public function noticeCreateOrEdit(Request $request)
    {
        $admin_user_id          = Auth::user()->id;
        $entry_permission       = $this->PermissionHasOrNot($admin_user_id, 121);
        $update_permission      = $this->PermissionHasOrNot($admin_user_id, 122);
        // update
        if (!is_null($request->input('edit_id')) && $request->input('edit_id') != "" && $update_permission) {
            $response_data =  $this->editNotice($request->all(), $request->input('edit_id'));
        }
        // new entry
        else if ($entry_permission) {
            $response_data =  $this->createNotice($request->all());
        } else {
            $return['result'] = 0;
            $return['message'] = "You are not authorized to insert a Subject";
            $response_data = json_encode($return);
        }
        return $response_data;
    }

    private function createNotice($request)
    {
        try {
            $rule = [
                'title'            => 'required',
                'details'          => 'required',
                'notice_date'      => 'required',
                'expire_date'      => 'required',
            ];

            $validation = \Validator::make($request, $rule);
            if ($validation->fails()) {
                $return['result']   = "0";
                $return['message']  = $validation->errors();
                return json_encode($return);
            } else {
                DB::beginTransaction();
                $notice = Notice::create([
                    'title'                 =>  $request['title'],
                    'notice_category_id'    =>  $request['notice_category_id'],
                    'details'               =>  $request['details'],
                    'notice_date'           =>  $request['notice_date'],
                    'expire_date'           =>  $request['expire_date'],
                    'status'                => (isset($request['status'])) ? 'Active' : 'Inactive'
                ]);

                $attachment = (isset($request['attachment']) && $request['attachment'] != "") ? $request['attachment'] : "";
                if ($attachment != "") {
                    $ext                = $attachment->getClientOriginalExtension();
                    $photoFullName      = $attachment->getClientOriginalName() . time() . '.' . $ext;
                    $upload_path        = 'assets/images/notice/';
                    $success            = $attachment->move($upload_path, $photoFullName);
                    $notice->attachment = $photoFullName;
                    $notice->update();
                }
                DB::commit();
                $return['result'] = 1;
                $return['message'] = "Notice Category saved successfully";
                return json_encode($return);
            }
        } catch (\Exception $e) {
            DB::rollback();
            $return['result']     = 0;
            $return['message'] = "Failed to save !" . $e->getMessage();
            return json_encode($return);
        }
    }

    private function editNotice($request, $id)
    {
        try {
            if ($id == "") {
                return json_encode(array('response_code' => 0, 'errors' => "Invalid request! "));
            }

            $notice = Notice::findOrFail($id);
            if (empty($notice)) {
                return json_encode(array('response_code' => 0, 'errors' => "Invalid request! No Category found"));
            }
            $rule = [
                'title'            => 'required',
                'details'            => 'required',
                'notice_date'            => 'required',
                'expire_date'            => 'required',

            ];

            $validation = \Validator::make($request, $rule);
            if ($validation->fails()) {
                $return['result'] = "0";
                $return['errors'] = $validation->errors();
                return json_encode($return);
            } else {
                DB::beginTransaction();
                $notice->title              = $request['title'];
                $notice->details            = $request['details'];
                $notice->notice_category_id = $request['notice_category_id'];
                $notice->notice_date        = $request['notice_date'];
                $notice->expire_date        = $request['expire_date'];
                $notice->status             =  (isset($request['status'])) ? "Active" : 'Inactive';
                $notice->update();

                $attachment = (isset($request['attachment']) && $request['attachment'] != "") ? $request['attachment'] : "";
                if ($attachment != "") {
                    $old_image          = $notice->attachment;
                    $image_name         = time();
                    $ext                = $attachment->getClientOriginalExtension();
                    $image_full_name    = $image_name . '.' . $ext;
                    $upload_path        = 'assets/images/notice/';
                    $success            = $attachment->move($upload_path, $image_full_name);
                    $notice->attachment = $image_full_name;
                    if (!is_null($old_image) && $notice->attachment != $old_image) {
                        File::delete($upload_path . $old_image);
                    }
                }
                $notice->update();

                DB::commit();
                $return['result'] = 1;
                $return['message'] = "Notice  Updated successfully";
                return json_encode($return);
            }
        } catch (\Exception $e) {
            DB::rollback();
            $return['response_code']     = 0;
            $return['errors'] = "Failed to update !" . $e->getMessage();
            return json_encode($return);
        }
    }

    public function getDownload($id)
    {
        if ($id == "") return 0;
        $notice     = Notice::findOrFail($id);
        $file       = 'assets/images/notice/' . $notice->attachment;
        return response()->download($file);
    }

    public function noticeShow($id)
    {
        if ($id == "") return 0;
        $notice     = Notice::findOrFail($id);
        return json_encode(array('notice' => $notice));
    }

    public function noticeDestroy($id)
    {
        if ($id == "") {
            throw new \Exception('Invalid request!');
        }
        $notice     = Notice::findOrFail($id);
        try {
            DB::beginTransaction();
            $old_image      = $notice->attachment;
            $upload_path    = 'assets/images/notice/';
            File::delete($upload_path . $old_image);
            $notice->delete();

            DB::commit();
            $return['result']    = 1;
            $return['message']          = "Notice Deleted successfully";
            return json_encode($return);
        } catch (\Exception $e) {
            DB::rollback();
            $return['result'] = 0;
            $return['message'] = "Failed to delete !" . $e->getMessage();
            return json_encode($return);
        }
    }
}
