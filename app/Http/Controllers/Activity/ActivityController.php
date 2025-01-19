<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ActivityService;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public $oActivityService;
    
    public function __construct(ActivityService $oActivityService)
    {
        $this->oActivityService = $oActivityService;
    }
    
    public function index()
    {
        return view('pages.admin.activity.create');
    }

    public function createActivityPage()
    {
        return view('pages.calendar.create');
    }


    public function createActivity(Request $request)
    {
        $data = $this->removeToken($request->all());
        $data['user_id'] = Auth::user()->id;

        $result = $this->oActivityService->createActivity($data);

        if ($result['status'] === true){
            Alert::success('Success', $result['message']);
            return redirect()->route('calendar_view');
        }

        Alert::error('Error', $result['message']);
        return redirect()->back()->with($result);
    }

    public function getActivityById($id)
    {
        $activities = $this->oActivityService->getActivityById($id);

        return view('pages.admin.activity.update', compact('activities'));
    }

    public function updateActivity(Request $request, $id)
    {
        $data = $this->removeMethod($request->all());
        $data = $this->removeToken($data);
        
        $result = $this->oActivityService->updateActivity($data, $id);
        dd($result);
        if ($result['status'] === true){
            Alert::success('Success', $result['message']);
            return redirect()->back()->with($result);
        }

        Alert::error('Error', $result['message']);
        return redirect()->back()->with($result);
    }

    public function markCompleted($id)
    {
        $data = ['active' => false];
        $result = $this->oActivityService->updateActivity($data, $id);
        return response()->json($result);
    }

    public function deleteActivity($id)
    {
        return response()->json($this->oActivityService->deleteActivity($id));
    }

    public function getUserActivity()
    {
        $current = $this->oActivityService->getActivitiesToday();
        $upcomming = $this->oActivityService->getUpcommingActivities();
        $data = [
            'current' => $current,
            'upcomming' => $upcomming
        ];
        return view('pages.calendar', compact('data'));
    }

    public function getActivities()
    {
        $activities = $this->oActivityService->getActivities();
        $activities = $this->formatActivity($activities, false, 'auto');

        return view('pages.calendar.view', compact('activities'));
    }

    public function viewAllActivies()
    {
        $years = $this->oActivityService->getActivitiesYear();
        $years = array_keys($years->toArray());
        return view('pages.calendar.print', compact('years'));
    }

    public function getAllActivities(Request $request)
    {
        $activities = $this->oActivityService->getAllActivities($request->year);
        $activities = $this->formatActivity($activities, true, 'background');

        return response()->json($activities);
    }

    private function formatActivity($activities,$duration, $display)
    {
        
        $formattedData = [];
        foreach($activities as $activity) {
            array_push($formattedData, [
                'title' => $activity['description'],
                'start' => $activity['start_date'],
                'end' => $activity['end_date'],
                'allDay' => $duration,
                'backgroundColor' => $activity['active'] === false || $activity['active'] === 0 ? 'gray' : '',
                'color' => $display === 'background' && ($activity['active'] === false || $activity['active'] === 0) ? 'grey' : '',
                'display' => $display,
                'event_type' => 'event'
            ]);
        }
        return $formattedData;
    }
}
