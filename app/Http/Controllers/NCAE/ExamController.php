<?php

namespace App\Http\Controllers\NCAE;

use App\Http\Controllers\Controller;
use App\Services\NCAEService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class ExamController extends Controller
{
    public $oNCAEService;

    private $months;

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
        $strands = $this->oNCAEService->getStrands();
        return view('pages.admin.exam.create', compact('strands'));
    }

    public function previewExam($id)
    {
        $exam = $this->oNCAEService->getExamById($id);
        $questions = $this->oNCAEService->getQuestions($id);
        $data = [
            'exam' => $exam,
            'questions' => $questions
        ];
        return view('pages.admin.exam.view', compact('data'));
    }

    public function createExam(Request $request)
    {
        $data = $this->removeToken($request->all());
        $count = $this->oNCAEService->checkExamByStrand($data['strand_id']);
        if ($count > 0 ) {
            Alert::error('Error', 'There is an existing exam with the specified strand, Please select a new one or update/delete the existing exam of the specified strand.');
            return redirect()->back(); 
        }
        $result = $this->oNCAEService->createExam($data);
        if ($result['status'] === true){
            Alert::success('Success', $result['message']);
            return redirect()->route('get_exam', $result['data']);
        }

        Alert::error('Error', $result['message']);
        return redirect()->back(); 
    }

    public function getExamById($id, Request $request)
    {
        if ($request->ajax()) {
            $questions = $this->oNCAEService->getQuestions($id);
            return datatables()->of($questions)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        // Update Button
                        $updateButton = '<button data-id="'.$row->id.'" id="updateQuestion" class="button-edit">Edit</button>';
                        // Delete Button
                        $deleteButton = '<button class="button-delete"><a href="javascript: deleteQuestion('.$row->id.')" data-confirm-delete="true">Delete</a></button>';
                        return '<div class="action-button">'. $updateButton.$deleteButton . '</div>';
                    })
                    ->editColumn('created_at', function($data)
                    { $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('Y-m-d H:i:s'); return $formatedDate; })
                ->make(true);
        }
        $title = 'Delete Question!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $exam = $this->oNCAEService->getExamById($id);
        $strands = $this->oNCAEService->getStrands();
        $data = [
            'exam' => $exam,
            'strands' => $strands
        ];
        return view('pages.admin.exam.update', compact('data'));
    }

    public function updateExam($id, Request $request)
    {
        try {
            $data = $this->removeToken($request->all());
            $data = $this->removeMethod($data);
            $this->oNCAEService->updateExam($id, $data);
            Alert::success('Success', 'Exam updated successfully!');
            return redirect()->route('admin_exam');
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function deleteExam($id)
    {
        $result = $this->oNCAEService->deleteExam($id);
        return response()->json($result);
    }

    public function questionIndex($id)
    {
        return view('pages.admin.exam.question.create', compact('id'));
    }

    public function createQuestion($id, Request $request)
    {
        $data = $this->removeToken($request->all());
        $data['exam_id'] = $id;
        $result = $this->oNCAEService->createQuestion($data);
        if ($result['status'] === true){
            Alert::success('Success', $result['message']);
            return redirect()->route('get_question', $result['data']);
        }

        Alert::error('Error', $result['message']);
        return redirect()->back(); 
    }

    public function updateQuestion($id, Request $request)
    {
        $data = $this->removeToken($request->all());
        $data = $this->removeMethod($data);
        $result = $this->oNCAEService->updateQuestion($id, $data);
        if ($result['status'] === true){
            Alert::success('Success', $result['message']);
            return redirect()->route('update_exam', $result['data']);
        }

        Alert::error('Error', $result['message']);
        return redirect()->back(); 
        dd($id, $data);
    }

    public function getQuestionById($id, Request $request)
    {
        if ($request->ajax()) {
            $questions = $this->oNCAEService->getChoices($id);
            return datatables()->of($questions)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        // Update Button
                        $updateButton = '<button type="button" data-id="'.$row->id.'" id="updateChoice" class="button-edit">Edit</button>';
                        // Delete Button
                        $deleteButton = '<button class="button-delete"><a href="javascript: deleteChoice('.$row->id.')" data-confirm-delete="true">Delete</a></button>';
                        return '<div class="action-button">'. $updateButton.$deleteButton . '</div>';
                    })
                    ->editColumn('correct', function($data)
                    { return $data->correct ? 'true' : 'false'; })
                ->make(true);
        }
        $title = 'Delete Choice!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $question = $this->oNCAEService->getQuestionById($id);
        return view('pages.admin.exam.question.update', compact('question'));
    }

    public function createChoices(Request $request)
    {
        $data = $this->removeToken($request->all());
        $data = $this->removeToken($request->all());
        $data['correct'] = $data['correct'] === 'true' ? true : false;
        $result = $this->oNCAEService->createChoices($data);
        ($result['status'] === true) ? Alert::success('Success', $result['message']) : Alert::error('Error', $result['message']);
        return redirect()->back(); 
    }

    public function deleteQuestion($id)
    {
        $result = $this->oNCAEService->deleteQuestion($id);
        return response()->json($result);
    }

    public function getChoiceById($id)
    {
        $result = $this->oNCAEService->getChoiceById($id);

        return response()->json($result);
    }

    public function updateChoices($id, Request $request)
    {
        $data = [
            'label' => $request->label,
            'correct' => $request->correct === 'true' ? true : false, 
        ];

        $result = $this->oNCAEService->updateChoice($id, $data);
        return response()->json($result); 
    }

    public function deleteChoices($id)
    {
        $result = $this->oNCAEService->deleteChoices($id);
        return response()->json($result);
    }

    public function examStatistics()
    {
        $year = Carbon::now()->format('Y');
        $result = $this->oNCAEService->getExamStatistics($year);
        $data = array();
        $dataSet = [];
        // dd($result->toArray());

        foreach($result as $key => $exams) {
            $this->initializeMonths();
            foreach($exams as $exam) {
                $month = $exam->created_at->format('M');
                $this->months[$month]++;
            }
            $data[$key] = array_values($this->months);
        }
        
        foreach ($data as $key => $strandExams) {
            $dataSet[$key] = [
                'label' => $key,
                'backgroundColor' => $this->chartColor[$key],
                'borderColor' => $this->chartColor[$key],
                'pointBorderColor' => $this->chartColor[$key],
                'pointBackgroundColor' => $this->chartColor[$key],
                'pointHoverBackgroundColor' => '#fff',
                'borderWidth' => 1,
                'tension' => .3,
                'data' => $strandExams
            ];
        }
        $exams = [
            'labels' => [
                'Jan', 
                'Feb', 
                'Mar', 
                'Apr', 
                'May', 
                'Jun', 
                'Jul', 
                'Aug', 
                'Sep', 
                'Oct', 
                'Nov', 
                'Dec'
            ],
            'data' => array_values($dataSet)
        ];
        // dd($exams);
        return view('pages.admin.exam.statistic', compact('exams'));
    }

    public function initializeMonths()
    {
        $this->months = [
            'Jan' => 0, 
            'Feb' => 0, 
            'Mar' => 0, 
            'Apr' => 0, 
            'May' => 0, 
            'Jun' => 0, 
            'Jul' => 0, 
            'Aug' => 0, 
            'Sep' => 0, 
            'Oct' => 0, 
            'Nov' => 0, 
            'Dec' => 0
        ];
    }
}
