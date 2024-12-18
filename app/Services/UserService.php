<?php

namespace App\Services;

use App\Models\User;
use App\Models\ParentDetails;
use App\Notifications\AccountCreationNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService {


    public function getUsers()
    {
        return User::where('role_id', 2)->get();
    }

    public function createUser($data)
    {
        try{
            DB::beginTransaction();
            $OTP = Str::random(8);
            $data['user']['password'] = $OTP;
            $user = User::create($data['user']);
            $user->notify(new AccountCreationNotification($user, $OTP));
            if (!empty($data['parent'])) {
                $data['parent']['user_id'] = $user->id;
                ParentDetails::create($data['parent'])->id;
            }

            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully created'
            ];
        }catch(\Exception $e){
            DB::rollback();
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function getUserById($id)
    {
        return User::where('id', $id)->with('parent')->first();
    }

    public function checkPassword($id)
    {
        return User::where('id', $id)->first();
    }

    public function checkUsername($username)
    {
        return User::where('username', $username)->count();
    }

    public function updateUser($data, $id)
    {
        try{
            DB::beginTransaction();
            User::where('id', $id)->update($data['user']);
            if (!empty($data['parent'])) {
                $data['parent']['user_id'] = (int) $id;
                ParentDetails::where('user_id', $id)->updateOrCreate($data['parent'])->id;
            }

            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully updated'
            ];
        }catch(\Exception $e){
            DB::rollback();
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function updatePassword($id, $password)
    {
        return User::where('id', $id)->update(['password' => Hash::make($password)]);
    }

    public function updateFirstLogin($id, $password)
    {
        try{
            DB::beginTransaction();
            
            $this->updatePassword($id, $password);

            User::where('id', $id)->update(['need_reset' => false]);
            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully updated'
            ];
        }catch(\Exception $e){
            DB::rollback();
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function deleteUser($id)
    {
        try{
            DB::beginTransaction();
            User::destroy($id);
            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully deleted'
            ];
        }catch(\Exception $e){
            DB::rollback();
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

}