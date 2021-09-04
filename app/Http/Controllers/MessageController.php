<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\MessageAttachment;
use App\Models\MessageMaster;
use App\Models\StudentClass;
use App\Models\Teacher;
use App\Models\TeacherSubject;
use App\Models\User;
use App\Traits\HasPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{

    use HasPermission;
    public function __construct(Request $request)
    {
        $this->page_title   = $request->route()->getName();
        $description        = \Request::route()->getAction();
        $this->page_desc    = isset($description['desc']) ? $description['desc'] : $this->page_title;
    }
    public function index()
    {
        $data['page_title']     = $this->page_title;
        $data['module_name']    = " Message & Notification";
        $data['sub_module']        = "Message";


        $admin_user_id          = Auth::user()->id;
        $add_action_id          = 128;
        $add_permission         = $this->PermissionHasOrNot($admin_user_id, $add_action_id);
        $data['actions']['add_permission'] = $add_permission;
        return view('notice.chat', $data);
    }
    ## Load app user for message
    public function loadAppUser()
    {
        $user_id = Auth::user()->typable_id;
        $student_class = StudentClass::where('student_id', '=', $user_id)->get();
        foreach ($student_class as $key => $student_class) {
            $class_id = $student_class->class_id;
            $class_subject = ClassSubject::where('class_id', '=', $class_id)->get();
            foreach ($class_subject as $key => $class_subject) {
                $teacher_subject = TeacherSubject::where('class_subject_id', '=', $class_subject->id)->get();
                foreach ($teacher_subject as $key => $teacher_subject) {
                    //  $app_users[] = Teacher::where('id','=', $teacher_subject->teacher_id) ->get();
                    // $teacher = Teacher::where('id','=', $teacher_subject->teacher_id) ->get();
                    $teacher = User::where('typable_id', '=', $teacher_subject->teacher_id)->get();
                }
            }
        }
        return response()->json(['data' => $teacher]);
    }


    public function loadMessage()
    {
        $app_user_id_load_msg     = $_POST['app_user_id_load_msg'];
        $page_no                 = $_POST['page_no'];
        $limit                     = $_POST['limit'];
        $message_load_type        = $_POST['message_load_type'];
        $last_appuser_message_id = $_POST['last_appuser_message_id'];
        $start = ($page_no * $limit) - $limit;
        $end   = $limit;
        // $message = array();
        // message_load_type
        // 1: all message dump first time
        // 2: get last message which just entered by admin
        // 3: get load more messages
        // 4: get appusers latest message
        // $message = MessageMaster::where('message_from','=',Auth::user()->id);
        // return response()->json(['data' => $message ]);


if ($message_load_type == 1 || $message_load_type == 3) {
    $id = Auth::user()->id;
    $user_id =  $app_user_id_load_msg;
    $message = MessageMaster::where([
        ['message_from', '=',  $id],
        ['message_to', '=',$user_id]
    ])
    ->orWhere([
        ['message_to', '=',  $id],
        ['message_from', '=',$user_id]
    ])
    ->groupBy('id')
    ->orderBy('id', 'desc')
    ->offset($start)
    ->limit($end)
    ->get();
    foreach ($message as $key => $message) {
        $message_name = $message->user->first_name;
    }



    return response()->json(['data' =>  $message_name]);
        // ->orWhere()
        // ->groupBy('id')
        // ->orderBy('mm.message_date_time', 'desc')
        // ->offset($start)
        // ->limit($end)
        // ->get();
}



        // MessageMaster::where('app_user_id', $app_user_id_load_msg)
        //     ->where('is_group_msg', 0)
        //     ->where('admin_message', null)
        //     ->where('is_attachment', 0)
        //     ->update(['is_seen' => 1]);

        // return json_encode(array(
        //     "message" => $message
        // ));
        // return response()->json(['data' => $message ]);
    }






    public function app_user_view($id)
    {
        // $data = User::find($id);
        $data = User::where('id', '=', $id)->first();
        // $groups =  DB::table('user_group_members as ugm')
        // 			->leftJoin('user_groups as ug', 'ugm.group_id', '=', 'ug.id')
        // 			->select(DB::raw('group_concat("", ug.group_name, "") AS group_name'))
        // 			->where('ugm.app_user_id', $id)
        // 			->where('ugm.status', 1)
        // 			->get();


        // return json_encode(array(
        // 	'data'=>$data,
        // 	 'groups'=>$groups,
        // ));
        return response()->json(['data' => $data]);
    }



    public function newMsgSent(Request $r)
    {
        return response()->json(['data' => $r]);
        if (isset($r->reply_msg_id)) {
            $reply_to = $r->reply_msg_id;
        } else {
            $reply_to = null;
        }
        $app_user_id = $r->app_user_id;
        $admin_message = $r->admin_message;

        $admin_id = Auth::user()->id;
        ## Image
        $attachment = $r->file('attachment');
        if (isset($r->edit_msg_id) && $r->edit_msg_id > 0) {
            MessageMaster::where('id', $r->edit_msg_id)->update(['admin_message' => $admin_message]);
            if ($r->hasFile('attachment')) {
                foreach ($attachment as $attachment) {
                    $attachment_name = rand() . time() . $attachment->getClientOriginalName();
                    $ext = strtoupper($attachment->getClientOriginalExtension());
                    echo $ext;
                    if ($ext == "JPG" || $ext == "JPEG" || $ext == "PNG" || $ext == "GIF" || $ext == "WEBP" || $ext == "TIFF" || $ext == "PSD" || $ext == "RAW" || $ext == "INDD" || $ext == "SVG") {
                        $attachment_type = 1;
                    } else if ($ext == "MP4" || $ext == "3GP") {
                        $attachment_type = 2;
                    } else if ($ext == "MP3") {
                        $attachment_type = 3;
                    } else {
                        $attachment_type = 4;
                    }
                    //$attachment_full_name = $attachment_name.'.'.$ext;
                    $upload_path = 'assets/images/message/';

                    $success = $attachment->move($upload_path, $attachment_name);
                    if ($success) MessageMaster::where('id', $r->edit_msg_id)->update(['is_attachment' => 1]);
                    ##Save image to the message attachment table
                    $msg_attachment = new MessageAttachment();
                    $msg_attachment->message_master_id = $r->edit_msg_id;
                    $msg_attachment->admin_atachment = $attachment_name;
                    $msg_attachment->attachment_type = $attachment_type;
                    $msg_attachment->save();
                }
            }
            return 1;
        } else {
            $new_msg = new MessageMaster();
            $new_msg->admin_id = $admin_id;
            $new_msg->admin_message = $admin_message;

            $new_msg->app_user_id = $app_user_id;
            $new_msg->reply_to = $reply_to;
            $new_msg->save();
            $mm_id = $new_msg->id;

            if ($r->hasFile('attachment')) {
                foreach ($attachment as $attachment) {
                    $attachment_name = rand() . time() . $attachment->getClientOriginalName();
                    $ext = strtoupper($attachment->getClientOriginalExtension());
                    echo $ext;
                    if ($ext == "JPG" || $ext == "JPEG" || $ext == "PNG" || $ext == "GIF" || $ext == "WEBP" || $ext == "TIFF" || $ext == "PSD" || $ext == "RAW" || $ext == "INDD" || $ext == "SVG") {
                        $attachment_type = 1;
                    } else if ($ext == "MP4" || $ext == "3GP") {
                        $attachment_type = 2;
                    } else if ($ext == "MP3") {
                        $attachment_type = 3;
                    } else {
                        $attachment_type = 4;
                    }
                    //$attachment_full_name = $attachment_name.'.'.$ext;
                    $upload_path = 'assets/images/message/';

                    $success = $attachment->move($upload_path, $attachment_name);
                    if ($success) MessageMaster::where('id', $mm_id)->update(['is_attachment' => 1]);

                    ##Save image to the message attachment table
                    $msg_attachment = new MessageAttachment();
                    $msg_attachment->message_master_id = $mm_id;
                    $msg_attachment->admin_atachment = $attachment_name;
                    $msg_attachment->attachment_type = $attachment_type;
                    $msg_attachment->save();
                }
            }
            return $mm_id;
        }
    }



    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
