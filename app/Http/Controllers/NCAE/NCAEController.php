<?php

namespace App\Http\Controllers\NCAE;

use App\Http\Controllers\Controller;
use App\Services\NCAEService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;

class NCAEController extends Controller
{
    public $oNCAEService;


    public function __construct(NCAEService $oNCAEService)
    {
        $this->oNCAEService = $oNCAEService;
    }

    public function index()
    {
        return view('pages.ncae');
    }

    public function strands()
    {
        $strands = $this->oNCAEService->getStrands();
        return view('pages.ncae.strand', compact('strands'));
    }

    public function career()
    {
        $strands = $this->oNCAEService->getStrands();
        return view('pages.ncae.career', compact('strands'));
    }

    public function ncaeTest()
    {
        $checkUserExam = $this->oNCAEService->getCheckUserExam(Auth::user()->id);
        $questions = $this->oNCAEService->getExams();
        // dd($exams->toArray());
        return view('pages.ncae.test', compact('questions'));
    }

    public function submitTest(Request $request)
    {
        $data = $this->removeToken($request->all());
        $answers = array_column($data['data'], 'answer');
        $answers = $this->removeNull($answers);
        // dd($answers);
        $result = ['status' => true];
        $count = $this->oNCAEService->checkAnswer($answers);

        $exam_data = [
            'score' => $count,
            'user_id' => Auth::user()->id,
        ];
        $submitExamResult = $this->oNCAEService->createUserExam($exam_data);
        if ($submitExamResult['status'] === false) {
            $result = $submitExamResult;
        }
        return response()->json($result);
    }

    public function result()
    {
        $label = [];
        $scoreData = [];
        $exams = $this->oNCAEService->result(Auth::user()->id);
        // dd(count($exams->toArray()));
        if(count($exams->toArray()) !== 0) {
            foreach ($exams as $key => $value) {
                $scoreData[] = $value->score;
                $label[] = Carbon::parse($value->created_at)->format('F d, Y');
            }
        }

        $data = [
            'labels' => $label,
            'score' => $scoreData
        ];
        
        return view('pages.ncae.result', compact('data'));
    }
}
