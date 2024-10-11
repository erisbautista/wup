<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public $oAdminService;

    public function __construct(AdminService $oAdminService)
    {
        $this->oAdminService = new $oAdminService();
    }

    public function getUsers(Request $request) 
    {
        if ($request->ajax()) {
            $users = $this->oAdminService->getUsers();
            return datatables()->of($users)
                    ->addColumn('action', function($row){

                        // Update Button
                        $updateButton = '<button data-id="'.$row->id.'" id="updateUser" class="button-edit">Edit</button>';
                        // Delete Button
                        $deleteButton = '<button class="button-delete"><a href="javascript: deleteUser('.$row->id.')" data-confirm-delete="true">Delete</a></button>';
                        return '<div class="action-button">'. $updateButton.$deleteButton . '</div>';
                    })
                    ->editColumn('created_at', function($data)
                    { $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('Y-m-d H:i:s'); return $formatedDate; })
                ->make(true);
        }

        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        // Alert::success('test','Test Alert');
        return view('pages.admin.user');
    }

    public function getViolations(Request $request) 
    {
        // $violations = $this->oAdminService->getViolations();
        // dd($violations);
        if ($request->ajax()) {
            $violations = $this->oAdminService->getViolations();
            return datatables()->of($violations)
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
        return view('pages.admin.violation.index');
    }
}
