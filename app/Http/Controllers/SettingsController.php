<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Setting::all();
        return view('settings.index' , compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Setting::findOrFail($id);
        return view('settings.edit' , compact('model'));
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
        $rules = [

            'about_app' => 'required|max:255',
            'fb_link' => 'required|url',
            'tw_link' => 'required|url',
            'inst_link' => 'required|url',
            'youtube_link' => 'required|url',
        ];

        $messages = [

            'about_app.required' => 'حقل عن التطبيق مطلوب',
            'about_app.max' => 'الحد الاقصي للكتابه لا يجب ان يتعدي 255 حرف',
            'fb_link.required' => 'لينك الفيسبوك مطلوب',
            'fb_link.url' => 'لينك الفيسبوك يجب ان يكتب بالطريقه الصحيحه',
            'tw_link.required' => 'لينك تويتر مطلوب',
            'tw_link.url' => 'لينك تويتر يجب ان يكتب بالطريقه الصحيحه',
            'inst.required' => 'لينك الانستجرام مطلوب',
            'inst_link.url' => 'لينك الانستجرام يجب ان يكتب بالطريقه الصحيحه',
            'youtube_link.required' => 'لينك اليوتيوب مطلوب',
            'youtube_link.url' => 'لينك اليوتيوب يجب ان يكتب بالطريقه الصحيحه',
        ];


        $this->validate($request , $rules , $messages);

        $records = Setting::findOrFail($id);
        $records->update($request->all());
        flash()->success('تم تحديث البيانات بنجاح');
        return redirect(route('setting.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
