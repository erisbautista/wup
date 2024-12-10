<?php

namespace App\Http\Controllers\NCAE;

use App\Http\Controllers\Controller;
use App\Services\NCAEService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
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
        if($checkUserExam !== 0) {
            Alert::error('Error', 'You already took the exam! you are redirected to the results page.');
            return redirect()->route('ncae_result');
        }
        $exams = $this->oNCAEService->getExams();
        return view('pages.ncae.test', compact('exams'));
    }

    public function submitTest(Request $request)
    {
        $data = $this->removeToken($request->all());
        $exams = $this->prepareData($data['data']);
        $result = ['status' => true];
        foreach ($exams as $key => $exam) {
            $count = 0;
            foreach ($exam as $question) {
                if ($question['answer'] === null) {
                    continue;
                }
                $answer_result = $this->oNCAEService->checkAnswer($question);
                if ($answer_result->correct === 1) {
                    $count++;
                }
            }
            $exam_data = [
                'result' => round(($count/count($exam)) * 100),
                'score' => $count,
                'user_id' => Auth::user()->id,
                'exam_id' => $key
            ];
            $submitExamResult = $this->oNCAEService->createUserExam($exam_data);
            if ($submitExamResult['status'] === false) {
                $result = $submitExamResult;
            }
        }
        return response()->json($result);
    }

    public function result()
    {
        $examResult = $this->oNCAEService->result(Auth::user()->id);
        // dd($examResult->toArray());
        $label = [];
        $scoreData = [];
        $totalData = [];
        // dd($examResult->toArray());
        foreach($examResult as $exam) {
            $question = $this->oNCAEService->getQuestions($exam->exam_id);
            array_push($totalData, $question->count());
            array_push($scoreData, $exam->score);
            array_push($label, $exam->exam->strand->name);
        }
        $chart = Chartjs::build()
         ->name('ResultBarchart')
         ->type('bar')
         ->labels($label)
         ->datasets([
             [
                "label" => "Total item",
                'backgroundColor' => '#81C784',
                'data' => $totalData,
                'order' => 2
             ],
             [
                "label" => "Score",
                'backgroundColor' => '#247547',
                'data' => $scoreData,
                'order' => 1
             ],
            ]);
        return view('pages.ncae.result', compact('chart'));
    }

    private function prepareData($data)
    {
        $exams = [];
        foreach ($data as $exam) {
            $exams[$exam['exam_id']][] = $exam;
        }
        return $exams;
    }
}
