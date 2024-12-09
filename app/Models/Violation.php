<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $fillable = [
        'name',
        'category_no'
    ];

    public function userViolations()
    {
        return $this->hasMany(UserViolation::class, 'violation_id');
    }
}
