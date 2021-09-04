<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserGroupMember extends Model
{
    protected $table = 'user_group_members';

    protected $fillable = [
        'group_id','user_id','status',
    ];

    public static function userPermissionGroupMembers($userId, $userGroupTypeId){

        //insert all the group and the admin user's data into user group member with value 0 (no permission)
        $userGroups = UserGroup::select('id')->where('type', $userGroupTypeId)->get();
        foreach ($userGroups as $userGroup) {
            $group_member_data = new UserGroupMember();
            $group_member_data->group_id    = $userGroup['id'];
            $group_member_data->user_id     = $userId;
            $group_member_data->status      = 0;
            $group_member_data->save();
        }
        $group = $userGroup['id'];
        // assign the user 'in selected groups and give the permission by (1)
        if ($group != "") {
            $groupEntry = UserGroupMember::where('group_id', $group)->where('user_id', $userId)->update(['status' => 1]);
        }
        return $groupEntry;
    }

    public static function editUserPermissionGroupMemebers($userID, $id) {
        $groups =  DB::table('user_group_members as ugm')
            ->leftJoin('user_groups as ug', 'ugm.group_id', '=', 'ug.id')
            ->select(DB::raw('group_concat("", ug.id, "") AS id'))
            ->where('ugm.user_id', $userID)
            ->where('ugm.status', 1)
            ->get();
        $group = $groups[0]->id;
        $do_not_permit = DB::table('user_group_members')
            ->where('user_id', $id)
            ->update(['status' => '0']);
        ## Set Admin Use Group Member
        if ($group != "") {
            if (isset($group)) {
                $status = '1';
                $groupMemberDetails = DB::table('user_group_members')
                    ->where('user_id', $id)
                    ->where('group_id', $group)
                    ->update(['status' => $status]);
            }
        }
        return $groupMemberDetails;
    }

}
