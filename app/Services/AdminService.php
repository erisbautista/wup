<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\History;
use App\Models\User;
use App\Models\Violation;
use Illuminate\Support\Facades\Auth;

class AdminService {


    public function getUsers()
    {
        try {
            return User::with('roles')->get();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getViolations()
    {
        try {
            return Violation::all();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getHistories()
    {
        try {
            return History::all();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getActivities()
    {
        try {
            return Activity::with('user')->get();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}