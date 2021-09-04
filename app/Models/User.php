<?php

namespace App\Models;

use App\Jobs\UsersRegistrationConfirmationMailJob;
use App\Mail\SchoolAdminsMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'type', 'typable_id', 'user_profile_image','contact_no','remarks','school_id','status','login_status','password',
    ];
    public function school()
    {
        return $this->belongsTo(School::class);
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Change login status according to $status.
     *
     * @param string $status
     * @return mixed
     */

    public static function LogInStatusUpdate($status)
    {
        if(\Auth::check()){
            if($status=='login') {
                $change_status=1;
            } else {
                $change_status=0;
            }
            $loginstatuschange = \App\Models\User::where('email',\Auth::user()->email)->update(array('login_status'=>$change_status));
            return $loginstatuschange;
        }
    }

	public function user_groups() {
        return $this->hasMany('App\Models\UserGroupMember', 'user_id');
    }

    public static function createUser($request){

        try {
            $rule = [
                'first_name' 		=> 'Required|max:220',
                'contact_no' 		=> 'Required|max:13',
                'email' 			=> 'Required|email',
                'user_profile_image'=> 'mimes:jpeg,jpg,png,svg'
            ];

            $validation = Validator::make($request, $rule);
            if ($validation->fails()) {
               return false;
            }
            else {
                $emailVerification = User::where('email', $request['email'])->first();
                if(isset($emailVerification->id)){
                    return false;
                }
                DB::beginTransaction();
                $status 	        = ($request['is_active'])?1:0;
                $user = User::create([
                    'first_name'	=> $request['first_name'],
                    'last_name'	    => (isset($request['last_name']))?$request['last_name']:"",
                    'contact_no'	=> $request['contact_no'],
                    'email'	        => $request['email'],
                    'status'		=> $status,
                    'password' 		=> (isset($request['password'])) ? bcrypt($request['password']) : bcrypt('1234'),
                    'remarks'		=> $request['remarks'],
                    'school_id'		=> (isset($request['school_id']))?$request['school_id']:null,
                    'type'	        => $request['type'],
                   'typable_id'	    => (isset($request['typable_id']))?$request['typable_id']:null,
                ]);

                $photo = (isset($request['user_profile_image']) && $request['user_profile_image']!= "")?$request['user_profile_image']:"";
                if ($photo!="") {
                    $ext                        = $photo->getClientOriginalExtension();
                    $photoFullName              = time().$photo->getClientOriginalName();
                    $uploadPath                 = 'assets/images/user/admin/';
                    $success                    = $photo->move($uploadPath, $photoFullName);
                    $user->user_profile_image   = $photoFullName;
                    $user->save();
                }

                if($user->id){
                $userPermissionGroupMembers = UserGroupMember::userPermissionGroupMembers($user->id, $request['user_group_type_id']);

                if($userPermissionGroupMembers) {
                        $username = $request['email'];
                        $password = 1234;
                        dispatch(new UsersRegistrationConfirmationMailJob($username, $password));
                    } else {
                    throw new \Exception("UserGroupMember Permission and Mail Send!");
                    }
                } else {
                    throw new \Exception("User!");
                }
                DB::commit();
                return true;
            }
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public static function editUser($request,  $id){
         try {

            if ($id == "") {
                return json_encode(array('result' => 0, 'message' => "Invalid Request!"));
            }

            $rule = [
                'first_name' => 'Required|max:220',
                'contact_no' => 'Required|max:13',
                'email' => 'Required|email',
                'user_profile_image' => 'mimes:jpeg,jpg,png,svg'
            ];

            $validation = Validator::make($request, $rule);
            if ($validation->fails()) {
                return false;
            } else {
                $emailVerification = User::where([['email', $request['email']], ['id', '!=', $id]])->first();
                if (isset($emailVerification->id)) {
                    return false;
                }
                DB::beginTransaction();
                $user                       = User::find($id);
                $user->first_name           = $request['first_name'];
                $user->last_name            = (isset($request['last_name']))?$request['last_name']:null;
                $user->email                = $request['email'];
                $user->contact_no           = $request['contact_no'];
                $user->password             = ($request['password'] == "") ? bcrypt('1234') : bcrypt($request['password']);
                $user->remarks              = $request['remarks'];
                $user->status               = (isset($request['is_active'])) ? 1 : 0;
                $user->update();
                $photo = (isset($request['user_profile_image']) && $request['user_profile_image']!= "")?$request['user_profile_image']:"";

                if ($photo!="") {
                    $ext = $photo->getClientOriginalExtension();
                    $photoFullName = time().$photo->getClientOriginalName();
                    $uploadPath = 'assets/images/user/admin/';
                    $success = $photo->move($uploadPath, $photoFullName);
                    $oldImage = $user->user_profile_image;

                    if ( $oldImage != "") {
                        $deleteImg = $uploadPath . $oldImage;
                        unlink($deleteImg);
                    }
                    $user->user_profile_image = $photoFullName;
                    $user->update();
                }
                if($user->id){
                    $editUserPermissionGroupMembers = UserGroupMember::editUserPermissionGroupMemebers($user->id, $id);
                       if($editUserPermissionGroupMembers != 1){
                           throw new \Exception("User!");
                       }
                }else {
                    throw new \Exception("User!");
                }
                DB::commit();
                return true;
            }
        }
            catch (\Exception $e){
                DB::rollback();
                return false;
            }
    }

}
