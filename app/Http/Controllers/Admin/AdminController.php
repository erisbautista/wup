<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
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
                        $changePasswordButton = '<button data-id="'.$row->id.'" id="changePassword" class="button-password-change">Change Password</button>';
                        // Delete Button
                        $deleteButton = '<button class="button-delete"><a href="javascript: deleteUser('.$row->id.')" data-confirm-delete="true">Delete</a></button>';
                        return '<div class="action-button">'. $updateButton.$deleteButton.$changePasswordButton . '</div>';
                    })
                    ->editColumn('created_at', function($data)
                    { $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('Y-m-d H:i:s'); return $formatedDate; })
                ->make(true);
        }

        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('pages.admin.user.index');
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

    public function getHistories(Request $request) 
    {
        if ($request->ajax()) {
            $history = $this->oAdminService->getHistories();
            return datatables()->of($history)
                    ->editColumn('created_at', function($data)
                    { $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('Y-m-d H:i:s'); return $formatedDate; })
                ->make(true);
        }
        return view('pages.admin.history');
    }

    public function getActivities(Request $request) 
    {
        if ($request->ajax()) {
            $activities = $this->oAdminService->getActivities();

            return datatables()->of($activities)
                    ->addColumn('action', function($row){
                                
                        // Update Button
                        $updateButton = '<button data-id="'.$row->id.'" id="updateActivity" class="button-edit">Edit</button>';
                        // Delete Button
                        $deleteButton = '<button class="button-delete"><a href="javascript: deleteActivity('.$row->id.')" data-confirm-delete="true">Delete</a></button>';
                        return '<div class="action-button">'. $updateButton.$deleteButton . '</div>';
                    })
                    ->editColumn('user_id', function($data)
                    { return $data['user']->first_name . ' ' . $data['user']->middle_name . ' ' . $data['user']->last_name; })
                    ->editColumn('created_at', function($data)
                    { $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('Y-m-d H:i:s'); return $formatedDate; })
                ->make(true);
        }
        $title = 'Delete Activity!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('pages.admin.activity.index');
    }
}
