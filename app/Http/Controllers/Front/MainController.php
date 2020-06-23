<?php

namespace App\Http\Controllers\Front;


use App\Models\BloodType;
use App\Models\Client;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\DonationRequest;

use App\Models\Post;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class MainController extends Controller
{
    public function home()
    {

        return view('front.home');
    }

    public function toggleFavourite(Request $request)
    {
        $toggle = $request->user()->posts()->toggle($request->post_id);
        return responseJson(1, 'success', $toggle);
    }

    public function about()
    {
        return view('front.about');
    }

    public function post()
    {
        return view('front.post');
    }


    public function postDetails($id)
    {
        $posts = Post::findOrFail($id);
        return view('front.post-details' , compact('posts'));
    }

    public function myFavourites(Request $request)
    {
        $favourites = $request->user()->posts()->latest()->paginate(20);
        return view('front.post-favourites' , compact('favourites'));
    }

    public function contact()
    {
        return view('front.contact');
    }


    public function contactSend(Request $request)
    {
        $rules =
            [
                'email' => 'required|email|',
                'phone' => 'required|min:11',
                'subject' => 'required',
                'message' => 'required',
            ];

        $this->validate($request, $rules);

        $contacts =Contact::create($request->all());
        if ($contacts)
        {
            flash()->success('تم تلقي الرساله بنجاح');
            return back();
        }else{
            flash()->error('message');
            return back();
        }

    }

    public function donation()
    {
        $donations = DonationRequest::paginate(4);
        return view('front.donation' ,compact('donations'));
    }

    public function donationDetails(Request $request , $id )
    {

       $donation = DonationRequest::findOrFail($id);


       return view('front.donation-details',compact('donation'));
    }

//    public function search(Request $request )
//    {
//        return $request->all();
//
//
//    }

    public function donationRequest()
    {
        return view('front.donation-request');
    }



    public function donationConfirm(Request $request)
    {
        $rules =[
            'patient_name' => 'required|max:255',
            'patient_phone' => 'required|min:11|',
            'patient_age' => 'required',
            'bags_num' => 'required',
            'hospital_name' => 'required',
            'hospital_address' => 'required',
            'details' => 'required|max:100',
            'city_id' => 'required|exists:cities,id',
            'client_id' => 'required|exists:clients,id',
            'blood_type_id' => 'required|exists:blood_types,id',
        ];

        $messages = [
            'patient_name.required' => 'اسم المريض مطلوب',
            'patient_phone.required' => 'هاتف المريض مطلوب',
            'patient_phone.min' => 'الهاتف يجب ان يكون علي الاقل 11 رقم ',
            'patient_age.required' => 'عدد اكياس الدم مطلوبه',
            'bags_num.required' => 'عمر المريض مطلوب',
            'hospital_name.required' => 'اسم المستشفي مطلوب',
            'hospital_address.required' => 'عنوان المستشفي مطلوب',
            'details.required' => 'التفاصيل مطلوبه',
            'city_id.required' => 'المدينه مطلوبه',
            'blood_type_id.required' => 'فصيلة الدم مطلوبه',
            'client_id.required' => 'اسم العضو مطلوب',
        ];

        $this->validate($request , $rules , $messages);


        $donation = DonationRequest::create($request->all());
            if ($donation) {
                flash()->success('تم اضافة طلب التبرع بنجاح');
                return redirect(route('donation'));
            }else{
                flash()->error('حدث خطأ برجاء اجراء طلب مره اخري');
                return back();
            }


    }

    public function profile($id)
    {
        $profile = client::findOrFail($id);

        return view('front.profile' , compact('profile'));
    }

    public function profileUpdate(Request $request , $id)
    {

        $rules = [
            'password' => 'confirmed',
            'phone' => Rule::unique('clients')->ignore($request->user()->id),
            'email' => Rule::unique('clients')->ignore($request->user()->id),
            'name' => 'required|max:255',
            'date_of_birth' => 'required|date',
            'city_id' => 'required|exists:cities,id',
            'last_donation_date' => 'required|date',
            'blood_type_id' => 'required|exists:blood_types,id',
        ];

        $this->validate($request , $rules);


        $record = Client::findOrFail($id);
        $record->update($request->all());
        if ($request->has('password'))
        {
            $record->password = bcrypt($request->password);
        }
        $record->save();

        if ($record)
        {
            flash()->success('تم تحديث البيانات بنجاح');
            return back();
        }else{
             flash()->success('حدث خطأ');
            return back();
        }

    }

    public function homeSearch(Request $request)
    {

        $records = DonationRequest::where(function ($query) use($request){
            if($request->has('city'))
            {
                $query->where('city_id',$request->city);
            }
            if ($request->has('bloodType'))
            {
                return $query->where('blood_type_id' , $request->bloodType);
            }

        })->get();
        return view('front.home-search' , compact('records'));
    }

    public function donationSearch(Request $request)
    {

        $records = DonationRequest::where(function ($query) use($request){
            if($request->has('city'))
            {
                $query->where('city_id',$request->city);
            }
            if ($request->has('bloodType'))
            {
                return $query->where('blood_type_id' , $request->bloodType);
            }

        })->get();
        return view('front.donation-search' , compact('records'));
    }




}
