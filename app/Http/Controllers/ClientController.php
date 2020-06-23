<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Client::all();
        return view('clients.index' , compact('records'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $rules =[

            'name' => 'required|max:255',
            'email' => 'required|email|unique:clients',
            'date_of_birth' => 'required|date',
            'city_id' => 'required|exists:cities,id',
            'phone' => 'required|unique:clients|min:11',
            'last_donation_date' => 'required|date',
            'password' => 'required|confirmed',
            'blood_type_id' => 'required|exists:blood_types,id',

        ];
        $messages =[

            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريدالالكتروني مطلوب',
            'email.unique' => 'قيمة البريدالالكتروني مستخدمه من قبل',
            'email.email' => 'البريدالالكتروني يجب ان يكون ايميل',
            'date_of_birth.required' => 'تاريخ الميلاد مطلوب',
            'date_of_birth.date' => 'تاريخ الميلاد يجب ان يكون في صيغة تاريخ',
            'city_id.required' => 'المدينه مطلوبه',
            'phone.required' => 'الهاتف مطلوب',
            'phone.unique' => 'قيمة الهاتف مستخدمه من قبل',
            'phone.min' => 'الهاتف يجب ان يكون علي الاقل 11 رقم',
            'last_donation_date.required' => 'اخر تاريخ تبرع مطلوب',
            'last_donation_date.date' => 'اخر تاريخ تبرع يجب ان يكون في صيغة تاريخ',
            'password.required' => 'كلمة المرور مطلوبه',
            'password.confirmed' => 'كلمة المرور يجب ان تكون متطابقه',
            'blood_type_id.required' => 'فصيلة الدم مطلوبه',

        ];

        $this->validate($request , $rules  ,$messages);

        $request->merge(['password' => bcrypt('password')]);
        $records = Client::create($request->all());
        flash()->success('تم الاضافة بنجاح');
        return redirect(route('client.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $model = Client::findOrFail($id);
        return view('clients.edit' , compact('model'));
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
            'phone' => Rule::unique('clients')->ignore($id),
            'email' => Rule::unique('clients')->ignore($id),
            'password' => 'confirmed',
            'name' => 'required|max:255',
            'date_of_birth' => 'required|date',
            'city_id' => 'required|exists:cities,id',
            'last_donation_date' => 'required|date',
            'blood_type_id' => 'required|exists:blood_types,id',
        ];$messages =[

        'name.required' => 'الاسم مطلوب',
        'email.required' => 'البريدالالكتروني مطلوب',
        'email.unique' => 'قيمة البريدالالكتروني مستخدمه من قبل',
        'email.email' => 'البريدالالكتروني يجب ان يكون ايميل',
        'date_of_birth.required' => 'تاريخ الميلاد مطلوب',
        'date_of_birth.date' => 'تاريخ الميلاد يجب ان يكون في صيغة تاريخ',
        'city_id.required' => 'المدينه مطلوبه',
        'phone.required' => 'الهاتف مطلوب',
        'phone.unique' => 'قيمة الهاتف مستخدمه من قبل',
        'phone.min' => 'الهاتف يجب ان يكون علي الاقل 11 رقم',
        'last_donation_date.required' => 'اخر تاريخ تبرع مطلوب',
        'last_donation_date.date' => 'اخر تاريخ تبرع يجب ان يكون في صيغة تاريخ',
        'password.required' => 'كلمة المرور مطلوبه',
        'password.confirmed' => 'كلمة المرور يجب ان تكون متطابقه',
        'blood_type_id.required' => 'فصيلة الدم مطلوبه',

    ];

        $this->validate($request , $rules  ,$messages);


        $record = Client::findOrFail($id);

        $record->update($request->all());

        if ($request->has('password')){
            $record->password = bcrypt($request->passwod);
        }

        $record->save();

        if ($record){
            flash()->success('تم التعديل بنجاح');
            return redirect(route('client.index'));
        }
        flash()->error('حدث خطأ برجاء المحاوله مره اخري');
        return redirect()->back();


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Client::findOrFail($id);
        if($record->BloodType()->count())
        {
            flash()->error('لا يمكن الحذف،توجد فصيله مرتبطه بالعضو');
            return back();
        }else{
            $record->delete();
        }

    }

    public function changeStatus($id)
    {
        $client = Client::findOrFail($id);
        $client->status =! $client->status;
        if ($client->save()){
            flash()->success('تم التعديل بنجاح');
            return redirect(route('client.index'));
        }else{
            flash()->error('حدث خطأ يرجي المحاوله مره اخري ');
            return redirect(route('change-status'));
        }

    }
    public function filter(Request $request)
    {

        $clients = Client::with("BloodType")->with("city.governorate")->where(function ($query) use($request){
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
        return view("clients.clients-filter",compact('clients'));
    }

}
