<?php

namespace App\Services;

use App\Models\Violation;
use App\Models\ParentDetails;
use Illuminate\Support\Facades\DB;

class ViolationService
{

    public function createViolation($data)
    {
        try{
            DB::beginTransaction();
            Violation::create($data);
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

    public function getViolationById($id)
    {
        return Violation::where('id', $id)->first();
    }

    public function updateViolation($data, $id)
    {
        try{
            DB::beginTransaction();
            Violation::where('id', $id)->update($data);
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

    public function deleteViolation($id)
    {
        try{
            DB::beginTransaction();
            Violation::destroy($id);
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