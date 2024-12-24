<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public $oUserService;

    public function __construct(UserService $oUserService)
    {
        $this->oUserService = $oUserService;
    }

    public function index()
    {
        return view('pages.login');
    }

    public function showLinkRequestForm()
    {
        return view('pages.forgot');
    }

    public function firstLogin()
    {
        $email = Auth::user()->email;
        return view('pages.password', compact('email'));
    }

    public function updatePassword(Request $request)
    {
        $id = Auth::user()->id;
        $password = $request->password;
        $result = $this->oUserService->updateFirstLogin($id, $password);

        if ($result['status'] === true){
            Auth::logout();
    
            $request->session()->invalidate();
        
            $request->session()->regenerateToken();
            Alert::success('Success', $result['message']);
            return redirect('/');
        }

        return redirect()->back();
    }

    public function showResetForm($token, Request $request)
    {
        $email = $request->email;
        $data = [
            'token' => $token,
            'email' => $email
        ];
        return view('pages.reset', compact('data'));
    }

    public function sendResetLinkEmail(Request $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        $status === Password::RESET_LINK_SENT ? Alert::success('Success', __($status)) : Alert::error('Error', __($status));
     
        return back();
    }

    public function resetPassword(Request $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );

        if($status === Password::PASSWORD_RESET) {
            Alert::success('Success', __($status));
            return redirect()->route('login');
        } else {
            Alert::error('Error', __($status));  
            return redirect()->back();
        }
    }

    public function authenticate(Request $request)
    {
        $landingPage = '/home';
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            // dd(Auth::user()->need_reset);
            if(Auth::user()->need_reset === true || Auth::user()->need_reset === 1) {
                Alert::success('Success', 'Welcome! As it is your first time logging in, please update your password!');
                return redirect()->intended('/password');
            }
            if (Auth::user()->role_id === 1) {
                $landingPage = '/admin/user';
            }
            if (Auth::user()->role_id === 4) {
                $landingPage = '/violation';
            }
            Alert::success('Success', 'Welcome! You have successfully logged in.');
            return redirect()->intended($landingPage);
        }

        Alert::error('Error', 'Incorrect username or password');
        return back();
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
