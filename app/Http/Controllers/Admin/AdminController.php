<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
                    ->addIndexColumn()
                    ->addColumn('role', function($row){
                        return $row->roles->name;
                    })
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

    public function getHistories(Request $request) 
    {
        // dd($history->toArray());
        if ($request->ajax()) {
            $history = $this->oAdminService->getHistories();
            return datatables()->of($history)
                    ->addIndexColumn()
                    ->editColumn('from', function($data) {
                        return 'Category ' . $data->violation1->category_no . ', ' . $data->violation1->name;
                    })
                    ->editColumn('to', function($data) {
                        return 'Category ' . $data->violation2->category_no . ', ' . $data->violation2->name;
                    })
                    ->editColumn('user_id', function($data) {
                        return $data->user->username;
                    })
                    ->editColumn('created_at', function($data)
                    { $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('Y-m-d H:i:s'); return $formatedDate; })
                ->make(true);
        }
        return view('pages.admin.history');
    }

    public function getExams(Request $request) 
    {
        if ($request->ajax()) {
            $exams = $this->oAdminService->getExams();
            return datatables()->of($exams)
                    ->addIndexColumn()
                    ->addColumn('strand', function($row){
                        return $row->strand->name;
                    })
                    ->addColumn('action', function($row){
                        
                        // Update Button
                        $updateButton = '<button data-id="'.$row->id.'" id="updateExam" class="button-edit button-first">Edit</button>';
                        $previewButton = '<button data-id="'.$row->id.'" id="viewExam" class="button-view button-second">View</button>';
                        // Delete Button
                        $deleteButton = '<button class="button-delete button-third"><a href="javascript: deleteExam('.$row->id.')" data-confirm-delete="true">Delete</a></button>';
                        return '<div class="action-button-three">'. $updateButton. $previewButton .$deleteButton . '</div>';
                    })
                    ->editColumn('created_at', function($data)
                    { $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('Y-m-d H:i:s'); return $formatedDate; })
                ->make(true);
        }
        $title = 'Delete Exam!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('pages.admin.exam.index');
    }

    public function getActivities(Request $request) 
    {
        if ($request->ajax()) {
            $activities = $this->oAdminService->getActivities();

            return datatables()->of($activities)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                                
                        $markCompleteButton = '';
                        // Update Button
                        $updateButton = '<button data-id="'.$row->id.'" id="updateActivity" class="button-edit button-first">Edit</button>';
                        // Delete Button
                        $deleteButton = '<button class="button-delete button-second"><a href="javascript: deleteActivity('.$row->id.')" data-confirm-delete="true">Delete</a></button>';
                        if ($row->active === true || $row->active === 1) {
                            $markCompleteButton = '<button data-id="'.$row->id.'" id="markComplete" class="button-view button-third">Mark as Complete</button>';
                        }
                        return '<div class="action-button-three">'. $updateButton.$deleteButton.$markCompleteButton. '</div>';
                    })
                    ->editColumn('active', function($data) {
                        return $data['active'] === 1 || $data['active'] === true ? 'true' : 'false';
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
