<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $records = City::paginate(20);
        return view('cities.index' , compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $rules = [
            'name'           => 'required|unique:cities,name',
            'governorate_id' => 'required|exists:governorates,id'
        ];
        $messages = [
            'name.required'           => 'اسم المدينه مطلوب',
            'name.unique'           => 'قيمة الاسم مستخدمه من قبل',
            'governorate_id.required' => 'المحافظه مطلوبه'
        ];

        $this->validate($request , $rules ,$messages);

        $records = City::create($request->all());
        flash()->success('تم اضافة المدينه بنجاح');
        return redirect(route('city.index'));

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
        $model = City::findOrFail($id);
        return view('cities.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name'           => 'required|unique:cities,name',
            'governorate_id' => 'required|exists:governorates,id'
        ];

        $messages = [
            'name.required'           => 'اسم المدينه مطلوب',
            'name.unique'           => 'قيمة الاسم مستخدمه من قبل',
            'governorate_id.required' => 'المحافظه مطلوبه'
        ];

        $this->validate($request , $rules ,$messages);

        $records = City::findOrFail($id);
        $records->update($request->all());
        flash()->success('تم تحديث المدينه بنجاح');
        return redirect(route('city.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $records = City::findOrFail($id);
        $records->delete();
        flash()->success('City deleted successfully');
        return redirect(route('city.index'));
    }

    public function search(Request $request)
    {


        $records = City::where(function ($query) use($request){
            if($request->input('name'))
            {
                $query->where('name',$request->name);
            }
            if ($request->input('governorate_id'))
            {
                $query->where('governorate_id' , $request->governorate_id);
            }
        })->get();
//        return $records;
        return view('cities.city-search' , compact('records'));
    }
}
