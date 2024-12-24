<?php

namespace App\Services;

use App\Models\History;
use App\Models\UserViolation;
use Illuminate\Support\Facades\DB;
use App\Models\Violation;

class UserViolationService
{

    public function getUserViolations()
    {
        return UserViolation::with(['user', 'violation'])->get();
    }

    public function getUserViolationsById($id)
    {
        return UserViolation::where('id', $id)->with(['user', 'violation'])->first();
    }

    public function updateUserViolation($id, $data)
    {
        try{
            DB::beginTransaction();
            UserViolation::where('id', $id)->update(['violation_id' => $data['to'], 'status' => 'pending']);
            History::create($data);
            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully updated violation record'
            ];
        }catch(\Exception $e){
            DB::rollback();
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function getUserViolationsPerUser($id)
    {
        return UserViolation::where('user_id', $id)->with(['user', 'violation'])->get();
    }

    public function completeViolation($id, $data)
    {
        try{
            DB::beginTransaction();
            UserViolation::where('id', $id)->update(['status' => 'completed']);
            History::create($data);
            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully Marked as completed'
            ];
        }catch(\Exception $e){
            DB::rollback();
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function getViolationAnalysis()
    {
        return Violation::withCount('userViolations')->get();
    }

    public function checkViolationCount($id)
    {
        return UserViolation::where('user_id', $id)->count();
    }

    public function deleteViolationByUserId($userId)
    {
        try{
            UserViolation::where('user_id', $userId)->destroy();

            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully created violation record'
            ];
        }catch(\Exception $e){
            DB::rollback();
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function createViolation($data)
    {
        try{
            DB::beginTransaction();
            UserViolation::create($data);
            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully created violation record'
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