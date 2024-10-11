<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminService {


    public function getUsers()
    {
        try {
            return User::with('roles')->get();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}