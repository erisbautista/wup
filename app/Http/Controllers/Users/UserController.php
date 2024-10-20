<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public $oUserService;

    public $parentFields = [
        'parent_first_name',
        'parent_middle_name',
        'parent_last_name',
        'parent_email'
    ];

    public function __construct(UserService $oUserService)
    {
        $this->oUserService = new $oUserService();
    }

    public function index()
    {
        return view('pages.admin.user.create');
    }

    public function createUser(Request $request)
    {
        $data = $this->refactorData($request->all());
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
        return view('pages.admin.user.update', compact('user'));
    }

    public function passwordView($id)
    {
        return view('pages.admin.user.password', compact('id'));
    }

    public function updatePassword(Request $request, $id)
    {
        dd($request->all());
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

    public function updateUser(Request $request, $id)
    {
        $data = $this->refactorData($request->all());
        $data['parent']['user_id'] = (int) $id;

        $result = $this->oAdminService->updateUser($data, (int) $id);

        if ($result['status'] === true){
            Alert::success('Success', $result['message']);
            return redirect()->route('admin_user');
        }

        Alert::error('Error', $result['message']);
        return redirect()->back()->with($result); ;
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
        $user = array_filter($requestData, function($data) {
            return !in_array($data, $this->parentFields) && $data != '_token' && $data != 'confirm_password' && $data != '_method';
        }, ARRAY_FILTER_USE_KEY); 
        $user['role_id'] = (int) $user['role_id'];
        return [
            'user' => $this->removeNull($user),
            'parent' => $this->removeNull([
                'first_name' => $parent['parent_first_name'],
                'middle_name' => $parent['parent_middle_name'],
                'last_name' => $parent['parent_last_name'],
                'email' => $parent['parent_email'],
            ])
        ];
    }

    private function removeNull($data)
    {
        return array_filter($data, static function($var){return $var !== null;} );
    }
    
}
