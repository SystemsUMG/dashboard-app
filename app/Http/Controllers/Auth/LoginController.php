<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
        $user = User::whereEmail($request->email)->first();
        if ($user && Hash::check($request->password, $user->password ?? '')) {
            $user->remember_token = rand(1000000, 9999999);
            $user->save();
            $data['code'] = $user->remember_token;
            Mail::to($user->email)->queue(new VerifyEmail($data));
            $this->message = 'Hemos enviado un código de seguridad a tu Correo Electrónico.';
            $this->status_code = 200;
        } else {
            $this->message = 'Credenciales incorrectas';
        }
        $this->response = [
            'message' => $this->message,
        ];
        return response()->json($this->response, $this->status_code);
    }

    public function verify(Request $request) {
        $user = $this->validateRequest($request);
        if ($user) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
                $user->remember_token = Str::random(15);
                $user->save();
                return redirect()->route('home');
            } else {
                return back()->with('error', 'Credenciales incorrectas');
            }
        } else {
            return back()->with('error', 'Usuario no encontrado');
        }
    }

    public function searchUser(Request $request) {
        $user = $this->validateRequest($request);
        if ($user) {
            return response()->json(null);;
        } else {
            return response()->json(['message' => 'Código inválido'], 400);
        }
    }

    private function validateRequest($request) {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'code' => ['required', 'numeric'],
        ]);
        return User::whereEmail($request->email)->where('remember_token', $request->code)->first();
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login.index');
    }
}
