<?php

namespace App\Services;

use App\Models\Activity;
use Carbon\Carbon;
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

    public function getActivitiesToday()
    {
        return Activity::whereDate('start_date', '<=', Carbon::now())->whereDate('end_date', '>=', Carbon::now())->get();
    }

    public function getUpcommingActivities()
    {
        return Activity::whereDate('start_date', '>', Carbon::now())->get();
    }
    public function getOngoingActivities()
    {
        return Activity::whereDate('start_date', '<=', Carbon::now())->whereDate('end_date', '>=', Carbon::now())->get();
    }

    public function getActivities()
    {
        return Activity::all();
    }

    public function getAllActivities($year)
    {
        return Activity::where( DB::raw('YEAR(start_date)'), '=', $year )->get();
    }

    public function getActivitiesYear()
    {
        return Activity::get()->groupBy(function($q) {
            return Carbon::parse($q->start_date)->format('Y');
        });
    }
}