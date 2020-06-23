<?php

namespace App\Http\Controllers;

use App\Models\DonationRequest;
use Illuminate\Http\Request;

class DonationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = DonationRequest::paginate(20);
        return view('donations.index' , compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('donations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        $this->validate($request , $rules,$messages );

        DonationRequest::create($request->all());
        flash()->success('تم اضافة طلب التبرع بنجاح');
        return redirect(route('donation.index'));



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $records = DonationRequest::findOrFail($id);

        return view('donations.show' , compact('records'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = DonationRequest::findOrFail($id);
        return view('donations.edit' , compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

        $this->validate($request , $rules,$messages );

        $record = DonationRequest::findOrFail($id);
        $record->update($request->all());
        flash()->success('تم تعديل طلب التبرع بنجاح');
        return redirect(route('donation.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $record = DonationRequest::findOrFail($id);
        if($record->BloodType()->count() || $record->client()->count() || $record->city()->count()){
            flash()->error('لا يمكن حذف الطلب');
            return redirect(route('donation.index'));
        }
        $record->delete();
        return redirect(route('donation.index'));
    }

    public function filter(Request $request)
    {


        $records = DonationRequest::with("BloodType")->with("city.governorate")->where(function ($query) use($request){
            if ($request->input('from') && $request->input('to'))
            {
                if($request->input('to') >= $request->input('from')){
                    $query->whereBetween('created_at', [$request->input('from'), $request->input('to')]);
                }
                if($request->input('to') <= $request->input('from')){
                    $query->whereBetween('created_at', [$request->input('to'), $request->input('from')]);
                }
            }
            if ($request->input('blood_type_id'))
            {
                $query->where('blood_type_id',$request->blood_type_id);
            }
            if ($request->input('client_id'))
            {
                $query->where('client_id',$request->client_id);
            }
            if ($request->input('city_id'))
            {
                $query->WhereHas('city',function ($city) use($request){
                    $city->where('city_id',$request->city_id);
                });
            }
            if ($request->input('governorate_id'))
            {
                $query->WhereHas('city.governorate',function ($govern) use($request){
                    $govern->where('governorate_id',$request->governorate_id);
                });
            }
        })->paginate(20);

        return view("donations.donation-filter",compact('records'));
    }
}
