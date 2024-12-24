<?php

namespace App\Http\Controllers\Violations;

use App\Http\Controllers\Controller;
use App\Services\ViolationService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class ViolationController extends Controller
{

    public $oViolationService;

    public function __construct(ViolationService $oViolationService)
    {
        $this->oViolationService = $oViolationService;
    }
    
    public function index(Request $request)
    {
        // $violations = $this->oAdminService->getViolations();
        // dd($violations);
        if ($request->ajax()) {
            $violations = $this->oViolationService->getViolations();
            return datatables()->of($violations)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        
                        // Update Button
                        $updateButton = '<button data-id="'.$row->id.'" id="updateViolation" class="button-edit">Edit</button>';
                        // Delete Button
                        $deleteButton = '<button class="button-delete"><a href="javascript: deleteViolation('.$row->id.')" data-confirm-delete="true">Delete</a></button>';
                        return '<div class="action-button">'. $updateButton.$deleteButton . '</div>';
                    })
                    ->editColumn('created_at', function($data)
                    { $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('Y-m-d H:i:s'); return $formatedDate; })
                ->make(true);
        }

        $title = 'Delete Violation!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        // Alert::success('test','Test Alert');
        return view('pages.violations.violation.index');
    }

    public function createViolationPage()
    {
        return view('pages.violations.violation.create');
    }

    public function createViolation(Request $request)
    {
        $data = $this->removeToken($request->all());

        $result = $this->oViolationService->createViolation($data);

        if ($result['status'] === true){
            Alert::success('Success', $result['message']);
            return redirect()->route('violation_index');
        }

        Alert::error('Error', $result['message']);
        return redirect()->back()->with($result);
    }

    public function getViolationById($id)
    {
        $violation = $this->oViolationService->getViolationById($id);
        
        return view('pages.violations.violation.update', compact('violation'));
    }

    public function updateViolation(Request $request, $id)
    {
        $data = $this->removeToken($request->all());
        $data = $this->removeMethod($data);

        $result = $this->oViolationService->updateViolation($data, $id);

        if ($result['status'] === true){
            Alert::success('Success', $result['message']);
            return redirect()->route('admin_violation');
        }

        Alert::error('Error', $result['message']);
        return redirect()->back()->with($result); ;
    }

    public function deleteViolation($id)
    {
        return response()->json($this->oViolationService->deleteViolation($id));
    }
}
