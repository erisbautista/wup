<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\UserViolationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public $oUserService;

    public $oUserViolationService;

    public $importMapping = [
        'first_name' => 0,
        'middle_name' => 1,
        'last_name' => 2,
        'email' => 3,
        'level' => 4,
        'username' => 5,
        'role_id' => 6,
        'parent_first_name' => 7,
        'parent_middle_name' => 8,
        'parent_last_name' => 9,
        'parent_email' => 10
    ];

    public $parentFields = [
        'parent_first_name',
        'parent_middle_name',
        'parent_last_name',
        'parent_email'
    ];

    public function __construct(UserService $oUserService, UserViolationService $oUserViolationService)
    {
        $this->oUserService = $oUserService;
        $this->oUserViolationService = $oUserViolationService;
    }

    public function index()
    {
        return view('pages.admin.user.create');
    }

    public function import()
    {
        return view('pages.admin.user.import');
        
    }

    public function importUsers(Request $request)
    {
        $storedFile = $request->input('file_import');
        $fileStream = fopen(storage_path('app/public/'. $storedFile), 'r');
        $skipHeader = true;
        $status = [
            'inserted' => 0,
            'skipped' => [
                'count' => 0,
                'message' => []
            ]
        ];
        while ($row = fgetcsv($fileStream)) {
            if ($skipHeader) {
                $skipHeader = false;
                continue;
            }
            $data = [
                'user' => [
                    'first_name' => $row[$this->importMapping['first_name']],
                    'middle_name' => $row[$this->importMapping['middle_name']],
                    'last_name' => $row[$this->importMapping['last_name']],
                    'level' => $row[$this->importMapping['level']],
                    'email' => $row[$this->importMapping['email']],
                    'username' => $row[$this->importMapping['username']],
                    'role_id' => $row[$this->importMapping['role_id']],
                ],
            ];
            if ($row[$this->importMapping['role_id']] === '2') {
                $data['parent'] = [
                    'first_name' => $row[$this->importMapping['parent_first_name']],
                    'middle_name' => $row[$this->importMapping['parent_middle_name']],
                    'last_name' => $row[$this->importMapping['parent_last_name']],
                    'email' => $row[$this->importMapping['parent_email']]
                ];
            } else {
                $data['parent'] = [];
            }
            $result = $this->oUserService->createUser($data);
        
            if ($result['status'] === false) {
                $status['skipped']['count']++;
                array_push($status['skipped']['message'],$result['message']);
                continue;
            }
            $status['inserted']++;
        }
        fclose($fileStream);
        Storage::disk('public')->delete($storedFile);
        Alert::info('info', 'Import completed successfully with the following status: inserted = '. $status['inserted'] . ', skipped = '.$status['skipped']['count']);
        return redirect()->route('admin_user'); 
    }

    public function downloadTemplate()
    {
        return response()->download(storage_path('app/public/users.csv'));
    }

    public function createUser(Request $request)
    {
        $data = $this->refactorData($request->all());
        // dd($data);
        
        $result = $this->oUserService->createUser($data);
        
        
        if ($result['status'] === true){
            Alert::success('Success', $result['message']);
            return redirect()->route('admin_user');
        }

        Alert::error('Error', $result['message']);
        return redirect()->back(); 
    }

    public function getUserById($id)
    {
        $user = $this->oUserService->getUserById($id);
        // dd($user->toArray());
        return view('pages.admin.user.update', compact('user'));
    }

    public function passwordView($id)
    {
        return view('pages.admin.user.password', compact('id'));
    }

    public function updatePassword(Request $request, $id)
    {
        try {
            $data = $request->all();
            $this->oUserService->updatePassword($data['id'], $data['password']);
            Alert::success('Success', 'Password updated successfully!');
            return redirect()->route('admin_user');
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function checkPassword(Request $request)
    {
        $data = $this->removeToken($request->all());
        $data = $this->removeMethod($data);

        $response = $this->oUserService->checkPassword((int) $data['id']);

        if(Hash::check($data['password'], $response->password)) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Incorrect password']);
    }

    public function checkUsername(Request $request)
    {
        $data = $this->removeToken($request->all());
        $data = $this->removeMethod($data);
        $count = $this->oUserService->checkUsername($request['username']);
        if($count === 0) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Username already taken']);
    }

    public function updateUser(Request $request, $id)
    {
        $data = $this->refactorData($request->all());

        $user = $this->oUserService->getUserById($id);
        $result = $this->oUserService->updateUser($data, (int) $id, $user->level);

        if ($result['status'] === true){
            Alert::success('Success', $result['message']);
            return redirect()->route('admin_user');
        }

        Alert::error('Error', $result['message']);
        return redirect()->back()->with($result);
    }

    public function deleteUser($id)
    {
        $result = $this->oUserService->deleteUser((int) $id);
        
        return response()->json($result);
    }

    private function refactorData($requestData)
    {
        $parent = array_filter($requestData, function($data) {
            return in_array($data, $this->parentFields);
        }, ARRAY_FILTER_USE_KEY);
        $parent = empty($parent) ? [] : $this->removeNull([
            'first_name' => $parent['parent_first_name'],
            'middle_name' => $parent['parent_middle_name'],
            'last_name' => $parent['parent_last_name'],
            'email' => $parent['parent_email'],
        ]);
        $user = array_filter($requestData, function($data) {
            return !in_array($data, $this->parentFields) && $data != '_token' && $data != 'confirm_password' && $data != '_method';
        }, ARRAY_FILTER_USE_KEY); 
        $user['role_id'] = (int) $user['role_id'];
        return [
            'user' => $this->removeNull($user),
            'parent' => $parent
        ];
    }
}
