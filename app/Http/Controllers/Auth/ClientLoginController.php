<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:client-web')->except('logout');
    }

    public function login()
    {
        if(!auth()->guard('client-web')->check()){
            return view('front.login');
        }
        return redirect('/');

    }


    public function loginSave(Request $request)
    {
        // laravel mobile login
        $rules = [

            'phone' => 'required|exists:clients|min:11',
            'password' => 'required',

        ];
        $messages = [
            'phone.required'          => 'رقم الهاتف مطلوب',
            'phone.min' => 'الهاتف يجب ان يكون علي الاقل 11 رقم ',
            'phone.exists' => 'بيانات الدخول غير صحيحه',
            'password.required'       => 'كلمة المرور مطلوبه',
        ];

        $this->validate($request, $rules , $messages);

        $client = auth()->guard('client-web')->attempt(['phone' => $request->phone , 'password' => $request->password]
            , $request->filled('remember'));

        if ($client) {
                return redirect(route('client-home'));
        }

        flash()->error('بيانات الدخول غير صحيحه');
        return back();
    }

    public function logout()
    {
        auth()->guard('client-web')->logout();

        return  redirect('/');
    }
}
