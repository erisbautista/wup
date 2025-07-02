<?php

namespace App\Services;

use App\Models\Choice;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Strand;
use App\Models\UserExam;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class NCAEService
{    
    public function getStrands()
    {
        return Strand::all();
    }

    public function getExamById($id)
    {
        return Exam::where('id', $id)->first();
    }

    public function getExams($id)
    {
        return Exam::where('strand_id', $id)->first();
    }

    public function getQuestionsByExamId($examId)
    {
        return Question::inRandomOrder()->with(['choices' => function($q) {
            $q->inRandomOrder();
        }])->limit(30)->where('exam_id', $examId)->get();
    }

    public function getCheckUserExam($id)
    {
        return UserExam::where('user_id', $id)->count();
    }

    public function getExamStatistics($year)
    {
        return UserExam::with('exam.strand')->whereYear('created_at', $year)->get()->groupBy('exam.strand.name');
    }

    public function checkAnswer($answer)
    {
        return Choice::whereIn('id', $answer)->where('correct', '=', 1)->count();
    }

    public function result($id)
    {
        return UserExam::with('exam.strand')->where('user_id', $id)->get()->groupBy('exam.strand.name');
    }

    public function getUserExamPerMonthByUserId($userId)
    {
        return UserExam::where('user_id', $userId)->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('M');
        });
    }

    public function createUserExam($exam)
    {
        try{
            DB::beginTransaction();
            $user = UserExam::create($exam)->id;
            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully created',
                'data' => $user
            ];
        }catch(\Exception $e){
            DB::rollback();
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function checkExamByStrand($strandId)
    {
        return Exam::where('strand_id', $strandId)->count();
    }

    public function getQuestions($id)
    {
        return Question::where('exam_id', $id)->with(['exam','choices'])->get();
    }

    public function getChoices($id)
    {
        return Choice::where('question_id', $id)->get();
    }

    public function getQuestionById($id)
    {
        return Question::where('id', $id)->first();
    }

    public function createExam($data)
    {
        try{
            DB::beginTransaction();
            $user = Exam::create($data)->id;
            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully created',
                'data' => $user
            ];
        }catch(\Exception $e){
            DB::rollback();
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function updateExam($id, $data)
    {
        try{
            DB::beginTransaction();
            Exam::where('id', $id)->update($data);
            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully updated',
            ];
        }catch(\Exception $e){
            DB::rollback();
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function deleteExam($id)
    {
        try{
            DB::beginTransaction();
            Exam::destroy($id);
            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully deleted'
            ];
        }catch(\Exception $e){
            DB::rollback();
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function createQuestion($data)
    {
        try{
            DB::beginTransaction();
            $user = Question::create($data)->id;
            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully created',
                'data' => $user
            ];
        }catch(\Exception $e){
            DB::rollback();
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function updateQuestion($id, $data)
    {
        try{
            DB::beginTransaction();
            Question::where('id', $id)->update($data);

            $questions = Question::where('id', $id)->first();
            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully created',
                'data' => $questions->exam_id
            ];
        }catch(\Exception $e){
            DB::rollback();
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function deleteQuestion($id)
    {
        try{
            DB::beginTransaction();
            Question::destroy($id);
            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully deleted'
            ];
        }catch(\Exception $e){
            DB::rollback();
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function createChoices($data)
    {
        try{
            DB::beginTransaction();
            Choice::create($data)->id;
            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully created',
            ];
        }catch(\Exception $e){
            DB::rollback();
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function getChoiceById($id)
    {
        return Choice::where('id', $id)->first();
    }

    public function updateChoice($id, $data)
    {
        try{
            DB::beginTransaction();
            Choice::where('id', $id)->update($data);
            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully updated',
            ];
        }catch(\Exception $e){
            DB::rollback();
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function deleteChoices($id)
    {
        try{
            DB::beginTransaction();
            Choice::destroy($id);
            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully deleted'
            ];
        }catch(\Exception $e){
            DB::rollback();
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}