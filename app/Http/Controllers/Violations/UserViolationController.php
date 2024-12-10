<?php

namespace App\Http\Controllers\Violations;

use App\Http\Controllers\Controller;
use App\Notifications\EmailNotification;
use App\Services\UserService;
use App\Services\UserViolationService;
use App\Services\ViolationService;
use Illuminate\Http\Request;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserViolationController extends Controller
{
    public $oUserViolationService;
    public $oUserService;
    public $oViolationService;

    public function __construct(UserViolationService $oUserViolationService, UserService $oUserService, ViolationService $oViolationService)
    {
        $this->oUserViolationService = $oUserViolationService;
        $this->oUserService = $oUserService;
        $this->oViolationService = $oViolationService;
    }


    public function index()
    {
        return view('pages.violation');
    }

    public function getRegisterViolationData()
    {
        $users = $this->oUserService->getUsers();
        $violations = $this->oViolationService->getViolations();
        $data = [
            'users' => $users,
            'violations' => $violations
        ];
        return view('pages.violations.register', compact('data'));
    }
    
    public function registerUserViolation(Request $request)
    {
        $data = $this->removeToken($request->all());
        // dd($data);
        $result = $this->oUserViolationService->createViolation($data);
        if ($result['status'] === true) {
            Alert::success('Success', $result['message']);
            $userViolationCount = $this->oUserViolationService->checkViolationCount($data['user_id']);
            if($userViolationCount > 3) {
                $user = $this->oUserService->getUserById($data['user_id']);
                $user->parent->notify(new EmailNotification($user));

            }
            return redirect()->back();
        } 
        Alert::error('Error', $result['message']);
            return redirect()->back();
    }

    public function getUserViolations(Request $request)
    {
        // dd($data->toArray());
        if ($request->ajax()) {
            $data = $this->oUserViolationService->getUserViolations();
            return datatables()->of($data)->addIndexColumn()->addColumn('username', function($row){
                return $row->user->username;
            })
            ->addColumn('violation', function($row){
                return 'Category '. $row->violation->category_no .', '. $row->violation->name;
            })->editColumn('created_at', function($data)
            { $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('Y-m-d H:i:s'); return $formatedDate; })
            ->make(true);
        }
        return view('pages.violations.recent');
    }

    public function getUserViolationById($id)
    {
        $userViolations = $this->oUserViolationService->getUserViolationsById($id);
        $users = $this->oUserService->getUsers();
        $violations = $this->oViolationService->getViolations();
        $data = [
            'violations' => $violations,
            'userViolations' => $userViolations
        ];
        // dd($userViolations->toArray());
        return view('pages.violations.update', compact('data'));
    }

    public function updateuserViolation($id, Request $request)
    {
        $data = [];
        $user = Auth::user()->id;
        $old = $this->oUserViolationService->getUserViolationsById($id);
        if ( $old->violation_id !== (int)$request->violation_id ) {
            $data = [
                'table_name' => 'User Violations',
                'record' => $id,
                'field' => 'violation',
                'from' => $old->violation_id,
                'to' => (int) $request->violation_id,
                'user_id' => $user
            ];
        }
        if (empty($data)) {
            Alert::info('No Changes Made!', 'You\'ve selected the same violation!');
            return redirect()->route('user_violation_record');
        }
        $result = $this->oUserViolationService->updateUserViolation($id, $data);
        $result['status'] === true ? Alert::success('Success', $result['message']) : Alert::error('Error', $result['message']);
        return redirect()->route('user_violation_record');
    }

    public function getRecordViolationData()
    {
        $users = $this->oUserService->getUsers();

        return view('pages.violations.record', compact('users'));
    }

    public function getUserViolationRecord(Request $request)
    {
        $data = $this->removeMethod($request->all());
        $data = $this->removeToken($data);
        $violations = $this->oUserViolationService->getUserViolationsPerUser((int) $data['user_id']);
        // dd($violations);
        return datatables()->of($violations)->addIndexColumn()
        ->addColumn('violation', function($row){
            return 'Category '. $row->violation->category_no .', '. $row->violation->name;
        })
        ->addColumn('action', function($row){

            // Update Button
            $updateButton = '<button data-id="'.$row->id.'" id="updateViolation" class="button-edit">Edit</button>';
            return '<div class="action-button-one">'. $updateButton .'</div>';
        })
        ->editColumn('created_at', function($data)
        { $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('Y-m-d H:i:s'); return $formatedDate; })
        ->make(true);
    }

    public function getViolationAnalysis()
    {
        $result = $this->oUserViolationService->getViolationAnalysis();
        // dd($result->toArray());
        $labels = array();
        $data = array();
        foreach($result as $violation) {
            array_push($labels, 'Category '. $violation->category_no);
            array_push($data, $violation->user_violations_count);
        }
        $chart = Chartjs::build()
         ->name('barChartTest')
         ->type('bar')
         ->labels($labels)
         ->datasets([
             [
                "label" => "User Violations",
                'backgroundColor' => '#81C784',
                'data' => $data
             ],
            ])
         ->options([
            'plugins' => [
                'legend' => [
                    'labels' => [
                        'color' => '#FFFFFF',
                    ]
                ]
            ],
            'scales' => [
                'y' => [
                    'ticks' => [
                        'color' => '#FFFFFF',
                    ]
                ],
                'x' => [
                    'ticks' => [
                        'color' => '#FFFFFF',
                    ]
                ]
            ]
        ]);
        return view('pages.violations.analysis', compact('chart'));
    }
}
