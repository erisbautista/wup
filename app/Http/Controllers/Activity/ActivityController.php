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

    public function createActivity(Request $request)
    {
        $data = $this->removeToken($request->all());
        $data['user_id'] = Auth::user()->id;

        $result = $this->oActivityService->createActivity($data);

        if ($result['status'] === true){
            Alert::success('Success', $result['message']);
            return redirect()->route('admin_activity');
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
        $data = $this->removeToken($request->all());
        $data = $this->removeMethod($data);

        $result = $this->oActivityService->updateActivity($data, $id);

        if ($result['status'] === true){
            Alert::success('Success', $result['message']);
            return redirect()->route('admin_activity');
        }

        Alert::error('Error', $result['message']);
        return redirect()->back()->with($result); ;
    }

    public function deleteActivity($id)
    {
        return response()->json($this->oActivityService->deleteActivity($id));
    }

}
