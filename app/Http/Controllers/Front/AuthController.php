<?php

namespace App\Http\Controllers\Front;

use App\Mail\ResetPassword;
use App\Models\Client;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    public function register()
    {
        if (auth()->guard('client-web')->check()) {
            return redirect(url('/'));

        }
        return view('front.register');
    }

    public function registerSave(Request $request)
    {
        $rules =
            [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:clients',
                'date_of_birth' => 'required|date',
                'city_id' => 'required|exists:cities,id',
                'phone' => 'required|unique:clients|min:11',
                'last_donation_date' => 'required|date',
                'password' => 'required|confirmed',
                'blood_type_id' => 'required|exists:blood_types,id',
            ];

        $messages = [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الالكتروني مطلوب',
            'email.unique' => 'قيمة البريد الالكتروني مستخدمه من قبل',
            'email.email' => 'البريد الالكتروني يجب ان يكون صحيحا',
            'date_of_birth.required' => 'تاريخ الميلاد مطلوب',
            'city_id.required' => 'المدينه مطلوبه',
            'phone.required' => 'الهاتف مطلوب',
            'phone.unique' => 'قيمة الهاتف مستخدمه من قبل',
            'phone.min' => 'الهاتف يجب ان يكون علي الاقل 11 رقم',
            'last_donation_date.required' => 'اخر تاريخ تبرع مطلوب',
            'password.required' => 'كلمة المرور مطلوبه',
            'password.confirmed' => 'كلمة المرور يجب ان تكون متطابقه',
            'blood_type_id.required' => 'فصيلة الدم مطلوبه',
        ];

        $this->validate($request, $rules, $messages);

        $request->merge(['password' => bcrypt($request->password)]);

        try {
            $client = Client::create($request->all());
            if ($client) {
                return redirect(url(route('client-login')));
            }
        } catch (Exception $exception) {
            echo "error";
        }

    }


    public function forgetPassword(Request $request)
    {

        return view('front.forget-password');
    }


    public function resetPassword(Request $request)
    {

//        return $request->all();
        $rules = [
            'phone' => 'required|exists:clients|min:11',
        ];
        $messages = [
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.exists' => 'الهاتف الذي ادخلته غير صحيح',
            'phone.min' => 'رقم الهاتف يجب ان يكون علي الاقل 11 رقم',
        ];

        $this->validate($request, $rules, $messages);

        $user = Client::where('phone', $request->phone)->first();
//        dd($user);
        if ($user) {

            $code = rand(111111, 999999);
            $update = $user->update(['pin_code' => $code]);
            if ($update) {

                Mail::to($user->email)
                    ->bcc("abdo.muhammed1122@gmail.com")
                    ->send(new ResetPassword($code));
                flash()->success('برجاء فحص بريدك الالكتروني');
                return redirect('new-password');
            }
            flash()->error('حدث خطأ برجاء المحاوله مره اخري');
            return back();

        }
        flash()->error('لا يوجد حسابات مرتبطه بهذا الهاتف');
        return back();
    }

    public function newPassword(Request $request)
    {

        return view('front.new-password');
    }


    public function newPasswordConfirm(Request $request)
    {
        $rules = [
            'pin_code' => 'required',
            'new_password' => 'required|confirmed'
        ];
        $messages = [
            'pin_code.required' => 'رمز الاسترجاع مطلوب',
            'new_password.required' => 'كلمة المرور مطلوبه',
            'new_password.confirmed' => 'كلمة المرور يجب ان تكون متطابقه'
        ];

      $this->validate($request ,$rules , $messages);

        $user = Client::where('pin_code', $request->pin_code)->where('pin_code', '!=', 0)->first();

        if ($user) {

            $user->password = bcrypt($request->password);
            $user->pin_code = null;

            if ($user->save()) {
               flash()->success('تم تغيير كلمة المرور بنجاح');
               return redirect(route('client-login'));
            } else {
                flash()->error('حدث خطأ برجاء المحاوله مره أخري');
                return back();
            }

        } else {
            flash()->error('هذا الكود غير صالح');
            return back();
        }

    }
}
