<?php

namespace App\Http\Controllers\Api;

use App\Mail\ResetPassword;
use App\Models\BloodType;
use App\Models\Client;
use App\Models\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:clients',
                'date_of_birth' => 'required|date',
                'city_id' => 'required|exists:cities,id',
                'phone' => 'required|unique:clients|min:11',
                'last_donation_date' => 'required|date',
                'password' => 'required|confirmed',
                'blood_type_id' => 'required|exists:blood_types,id',
            ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $request->merge(['password' => bcrypt($request->password)]);

        $client = Client::create($request->all());

        $client->api_token = str_random(60);

        $client->save();

        return responseJson(1, 'تم التسجيل بنجاح', [
            'api_token' => $client->api_token,
            'client' => $client
        ]);
    }

    public function login(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'phone' => 'required|min:11',
                'password' => 'required',
            ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }


        $client = Client::where('phone', $request->phone)->first();
        if ($client) {
            if (Hash::check($request->password, $client->password)) {
                return responseJson(1, 'تم تسجيل الدخول بنجاح', [
                    'api_token' => $client->api_token,
                    'client' => $client,
                ]);

            } else {
                return responseJson(0, 'بيانات الدخول غير صحيحه');
            }

        } else {
            return responseJson(0, 'بيانات الدخول غير صحيحه');
        }

    }

    public function resetPassword(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'phone' => 'required'
            ]);

        if ($validator->fails()) {
            $data = $validator->errors();
            return responseJson(0, $validator->errors()->first(), $data);
        }

        $user = Client::where('phone', $request->phone)->first();
        if ($user) {

            $code = rand(1111, 9999);
            $update = $user->update(['pin_code' => $code]);

            if ($update) {

                Mail::to($user->email)
                    ->bcc("abdo.muhammed1122@gmail.com")
                    ->send(new ResetPassword($code));
                return responseJson(1, 'برجاء فحص هاتفك',
                    [
                        'pin_code_for_test' => $code,
                    ]);
            } else {
                return responseJson(0, 'حدث خطأ برجاء المحاوله مره أخري');
            }
        } else {
            return responseJson(0, 'لا توجد أرقام مرتبطه بهذا الرقم');
        }
    }


    public function newPassword(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'pin_code' => 'required',
                'password' => 'required|confirmed'
            ]);

        if ($validator->fails()) {
            $data = $validator->errors();
            return responseJson(0, $validator->errors()->first(), $data);
        }

        $user = Client::where('pin_code', $request->pin_code)->where('pin_code', '!=', 0)->first();

        if ($user) {

            $user->password = bcrypt($request->password);
            $user->pin_code = null;

            if ($user->save()) {
                return responseJson(1, 'تم تغيير كلمة المرور بنجاح');
            } else {
                return responseJson(0, 'حدث خطأ برجاء المحاوله مره أخري');
            }

        } else {
            return responseJson(0, 'هذا الكود غير صالح');
        }

    }

    public function registerToken(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'token' => 'required',
            'type' => 'required|in:android,ios'
        ]);

        if ($validator->fails()) {
            $data = $validator->errors();
            return responseJson(0, $validator->errors()->first(), $data);
        }

        Token::where('token', $request->token)->delete();
        $request->user()->tokens()->create($request->all());

        return responseJson(1, 'تم التسجيل بنجاح');

    }

    public function removeToken(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'token' => 'required|'
        ]);

        if ($validator->fails()) {
            $data = $validator->errors();
            return responseJson(0, $validator->errors()->first(), $data);
        }

        Token::where('token', $request->token)->delete();
        return responseJson(1, 'تم الحذف بنجاح');
    }


}
