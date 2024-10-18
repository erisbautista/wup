<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Support\Facades\DB;

class ActivityService
{

    public function createActivity($data)
    {
        try{
            DB::beginTransaction();
            Activity::create($data);
            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully created activity record'
            ];
        }catch(\Exception $e){
            DB::rollback();
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function getActivityById($id)
    {
        return Activity::where('id', $id)->first();
    }

    public function updateActivity($data, $id)
    {
        try{
            DB::beginTransaction();
            Activity::where('id', $id)->update($data);
            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully updated activity record'
            ];
        }catch(\Exception $e){
            DB::rollback();
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function deleteActivity($id)
    {
        try{
            DB::beginTransaction();
            Activity::destroy($id);
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