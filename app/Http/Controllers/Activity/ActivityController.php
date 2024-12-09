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
            return redirect()->back()->with($result);
        }

        Alert::error('Error', $result['message']);
        return redirect()->back()->with($result);
    }

    public function getActivityById($id)
    {
        $activities = $this->oActivityService->getActivityById($id);

        return view('pages.admin.activity.update', compact('activities'));
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

        $activities = $this->formatActivity($activities);

        return view('pages.calendar.view', compact('activities'));
    }

    private function formatActivity($activities)
    {
        $formattedData = [];
        foreach($activities as $activity) {
            array_push($formattedData, [
                'title' => $activity['description'],
                'start' => $activity['start_date'],
                'end' => $activity['end_date'],
                'allDay' => false
            ]);
        }
        return $formattedData;
    }
}
