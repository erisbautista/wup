<?php

namespace App\Services;

use App\Models\User;
use App\Models\ParentDetails;
use Illuminate\Support\Facades\DB;

class UserService {

    public function createUser($data)
    {
        try{
            DB::beginTransaction();
            $user = User::create($data['user'])->id;
            $data['parent']['user_id'] = $user;
            ParentDetails::create($data['parent'])->id;

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

    public function updateUser($data, $id)
    {
        try{
            DB::beginTransaction();
            User::where('id', $id)->update($data['user']);
            ParentDetails::where('user_id', $id)->updateOrCreate($data['parent'])->id;

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