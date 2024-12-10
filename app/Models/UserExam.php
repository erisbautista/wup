<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'result',
        'score',
        'user_id',
        'exam_id'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

}
