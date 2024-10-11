<?php

namespace App\Http\Controllers\Violations;

use App\Http\Controllers\Controller;
use App\Services\ViolationService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ViolationController extends Controller
{

    public $oViolationService;

    public function __construct(ViolationService $oViolationService)
    {
        $this->oViolationService = $oViolationService;
    }
    
    public function index()
    {
        return view('pages.admin.violation.create');
    }

    public function createViolation(Request $request)
    {
        $data = $this->removeToken($request->all());

        $result = $this->oViolationService->createViolation($data);

        if ($result['status'] === true){
            Alert::success('Success', $result['message']);
            return redirect()->route('admin_violation');
        }

        Alert::error('Error', $result['message']);
        return redirect()->back()->with($result); ;
    }
}
