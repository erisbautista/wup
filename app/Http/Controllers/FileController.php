<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    
    public function upload(Request $request)
    {
        if ($request->file('file_import')) {
            $path = $request->file('file_import')->storeAs('/tmp', Str::random(40) . '.'. $request->file('file_import')->getClientOriginalExtension(), 'public');
        }
        return $path;
    }
    public function revert(Request $request)
    {
        Storage::disk('public')->delete($request->getContent());
    }

}
