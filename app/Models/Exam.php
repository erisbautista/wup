<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'strand_id'
    ];

    public function strand()
    {
        return $this->belongsTo(Strand::class, 'strand_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'exam_id');
    }
}
