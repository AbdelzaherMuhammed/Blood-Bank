<?php

namespace App\Http\Controllers\Api;

use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\DonationRequest;
use App\Models\Governorate;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Token;
use DemeterChain\C;
use http\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class MainController extends Controller
{
    public function governorates(Request $request)
    {
        $governorates = Governorate::all();
        return responseJson(1, 'success', $governorates);
    }


    public function cities(Request $request)
    {
        $cities = City::where(function ($query) use ($request) {
            if ($request->has('governorate_id')) {

                $query->where('governorate_id', $request->governorate_id);
            }
        })->with('governorate')->get();

        return responseJson(1, 'success', $cities);
    }


    public function posts(Request $request)
    {
        $posts = Post::where(function ($query) use ($request) {

            // details of post
            if ($request->has('id')) {

                $query->where('id', $request->id);
            }

            // post with category
        })->where(function ($query) use ($request) {
            if ($request->has('category_id')) {
                $query->where('category_id', $request->category_id);
            }
        })->with('category')->paginate(10);

        return responseJson(1, 'success', $posts);
    }


    public function categories(Request $request)
    {
        $categories = Category::all();

        return responseJson(1, 'success', $categories);
    }


    public function bloodTypes()
    {
        $bloodTypes = BloodType::all();

        return responseJson(1, 'success', $bloodTypes);
    }


    public function aboutUs()
    {
        $about = Setting::all();

        return responseJson(1, 'success', $about);

    }


    public function contactUs(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'phone' => 'required|min:11',
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required'
            ]);

        if ($validator->fails()) {

            $data = $validator->errors();
            return responseJson(0, $validator->errors()->first(), $data);
        }

        $contact = Contact::create($request->all());
        //$contact = $request->user()->contacts()->create($request->all());
        return responseJson(1, 'تم اضافة الطلب', $contact);
    }


    public function profile(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'password' => 'confirmed',
                'phone' => Rule::unique('clients')->ignore($request->user()->id),
                'email' => Rule::unique('clients')->ignore($request->user()->id)
            ]);
        if ($validator->fails()) {
            $data = $validator->errors();
            return responseJson(0, $validator->errors()->first(), $data);
        }
        $loginUser = $request->user();

        $loginUser->update($request->all());

        if ($request->has('password')) {
            $loginUser->password = bcrypt($request->password);
        }

        $loginUser->save();

        $data = [
            'client' => $request->user()->fresh()->load('city.governorate', 'BloodType')
        ];
        return responseJson(1, 'تم تحديث البيانات', $data);

    }


    public function notificationSettings(Request $request)
    {
        $rules = [
            'governorates' => 'exists:governorates,id|array',
            'blood_types' => 'exists:blood_types,id|array'
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            $data = $validator->errors();
            return responseJson(0, $validator->errors()->first(), $data);
        }

        if ($request->has('governorates')) {
            $request->user()->governorates()->detach($request->governorates);
            $request->user()->governorates()->attach($request->governorates);
        }

        if ($request->has('blood_types')) {
            $request->user()->BloodTypes()->detach($request->blood_types);
            $request->user()->BloodTypes()->attach($request->blood_types);
        }

        $data = [
            'governorates' => $request->user()->governorates()->pluck('governorates.id')->toArray(),
            'blood_types' => $request->user()->BloodTypes()->pluck('blood_types.id')->toArray()
        ];
        return responseJson(1, 'تم التحديث', $data);
    }


    public function postFavourite(Request $request)
    {
        $rules = [
            'post_id' => 'required|exists:posts,id'
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            $data = $validator->errors();
            return responseJson(0, $validator->errors()->first(), $data);
        }
        $toggle = $request->user()->posts()->toggle($request->post_id);
        return responseJson(1, 'success', $toggle);
    }


    public function myFavoutits(Request $request)
    {
        $favourits = $request->user()->posts()->latest()->paginate(20);
        return responseJson(1, 'Loaded....', $favourits);
    }


    public function donations(Request $request)
    {
        $donation = DonationRequest::where(function ($query) use ($request) {
            if ($request->has('blood_type_id')) {
                $query->where('blood_type_id', $request->blood_type_id);
            }

            if ($request->input('governorate_id')) {
                $query->whereHas('city', function ($query) use ($request) {
                    $query->where('governorate_id', $request->governorate_id);
                });
            }

            if ($request->has('blood_type_id') && $request->input('governorate_id')) {
                $query->whereHas('city', function ($query) use ($request) {
                    $query->where('governorate_id', $request->governorate_id);
                })->where('blood_type_id', $request->blood_type_id);
            }

        })->with('city.governorate', 'BloodType')->paginate(10);
        return responseJson(1, 'success', $donation);
    }


    public function donationDetails(Request $request)
    {
        $donation = DonationRequest::with('city', 'BloodType', 'client')->find($request->donation_id);

        if (!$donation) {
            return responseJson(0, 'لا يوجد طلب تبرع مماثل');
        }

        if ($request->user()->notifications()->where('donation_request_id', $donation->id)) {

            $request->user()->notifications()->updateExistingPivot($donation->notification->id, [
                'is_read' => 1
            ]);

        }

        return responseJson(1, 'success', $donation);

    }

    public function notificationList(Request $request)
    {

        $notifications = $request->user()->notifications()->with('clients')->latest()->paginate(10);
        return responseJson(1, 'loaded ..', $notifications);

    }


    public function CreateDonations(Request $request)
    {
        $validator = validator()->make($request->all(), [

            'patient_phone' => 'required|max:255',
            'patient_age' => 'required',
            'bags_num' => 'required',
            'hospital_name' => 'required',
            'hospital_address' => 'required',
            'blood_type_id' => 'required|exists:blood_types,id',
            'city_id' => 'required|exists:cities,id',
            'lattitude' => 'required',
            'longitude' => 'required'


        ]);

        if ($validator->fails()) {
            $data = $validator->errors();
            return responseJson(0, $validator->errors()->first(), $data);
        }

        // create donation request
        $donationRequest = $request->user()->donations()->create($request->all());


        //find clients suitable for this donation request
        $clientsIds = $donationRequest->city->governorate
            ->clients()->whereHas('BloodTypes', function ($query) use ($request, $donationRequest) {
                $query->where('blood_types.id', $donationRequest->blood_type_id);
            })->pluck('clients.id')->toArray();

        // dd($clientsIds);

        if (count($clientsIds)) {

            //create notification on database
            $notification = $donationRequest->notification()->create([
                'title' => 'يوجد حالة تبرع قريبه منك',
                'content' => $donationRequest->BloodType->name . 'يوجد تبرع لفصيلة'
            ]);

            //attach clients to this notification
            $notification->clients()->attach($clientsIds);

            //get tokens for FCM(push notifications using firebase cloud)
            $tokens = Token::whereIn('client_id', $clientsIds)->where('token', '!=', null)->pluck('token')->toArray();

//dd($tokens);

            if (count($tokens)) {
                $title = $notification->title;
                $body = $notification->body;
                $data = [
                    'donation_request_id' => $donationRequest->id
                ];

                $send = notifyByFirebase($title, $body, $tokens, $data);
                info("firebase result :" . $send);
                // dd($send);

            }

        }

        return responseJson(1, 'تم الاضافه بنجاح ', compact('donationRequest'));

    }


//    public function testNotification(Request $request)
//    {
//        $tokens = $request->token;
//        $title = $request->title;
//        $body = $request->body;
//        $data = DonationRequest::pluck('id');
//        $send = notifyByFirebase($title , $body , $tokens , $data );
//        return responseJson(1 , 'تم الارسال بنجاح' , $send);
//    }


}

