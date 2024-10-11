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
}