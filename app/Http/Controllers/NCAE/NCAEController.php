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

    public $chartColor = [
        'tvl' => '#006d77',
        'stem' => '#e85d04',
        'humss' => '#52796f',
        'abm' => '#a68a64',
        'gas' => '#800e13'
    ];


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

    public function getStrands()
    {
        $strands = $this->oNCAEService->getStrands();
        return view('pages.ncae.menu', compact('strands'));
    }

    public function career()
    {
        $strands = $this->oNCAEService->getStrands();
        return view('pages.ncae.career', compact('strands'));
    }

    public function ncaeTest($id)
    {
        $exam = $this->oNCAEService->getExams($id);
        $questions = $this->oNCAEService->getQuestionsByExamId($exam->id);
        return view('pages.ncae.test', compact('questions'));
    }

    public function submitTest(Request $request)
    {
        $data = $this->removeToken($request->all());
        $exam_id = $data['data'][0]['exam_id'];
        $answers = array_column($data['data'], 'answer');
        $answers = $this->removeNull($answers);
        $result = ['status' => true];
        $count = $this->oNCAEService->checkAnswer($answers);

        $exam_data = [
            'score' => $count,
            'exam_id' => $exam_id,
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
        $dataSet = [];
        $exams = $this->oNCAEService->result(Auth::user()->id);
        // dd($exams->toArray());
        if(count($exams->toArray()) !== 0) {
            foreach ($exams as $key => $strandExams) {
                $dataSet[$key] = [
                    'label' => $key,
                    'backgroundColor' => $this->chartColor[$key],
                    'borderColor' => $this->chartColor[$key],
                    'pointBorderColor' => $this->chartColor[$key],
                    'pointBackgroundColor' => $this->chartColor[$key],
                    'pointHoverBackgroundColor' => '#fff',
                    'borderWidth' => 1,
                    'tension' => .3
                ];
                foreach ($strandExams as $strandKey => $value) {
                    $date = Carbon::now();
                    $dataSet[$key]['data'][] = [
                        'x' => $date->addDays($strandKey + 1)->format('M d'),
                        'y' => $value->score
                    ];
                }
            }
        }

        $data = [
            'dataset' => array_values($dataSet)
        ];
        // dd($data);
        
        return view('pages.ncae.result', compact('data'));
    }
}
