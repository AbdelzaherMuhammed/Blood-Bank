<?php

namespace App\Http\Controllers;

use App\Models\Governorate;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $records = Governorate::paginate(20);
        return  view('governorates.index' , compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('governorates.create');
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
          'name' => 'required|unique:governorates'
        ];

        $messages = [
            'name.required' => 'اسم المحافظه مطلوب',
            'name.unique' => 'اسم المحافظه مستخدم من قبل'
        ];

        $this->validate($request , $rules , $messages);

        $records = Governorate::create($request->all());
        flash()->success('تم اضافة المحافظة بنجاح');
        return redirect(route('governorate.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
        $model = Governorate::findOrFail($id);
        return view('governorates.edit' , compact('model'));
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
            'name' => 'required|unique:governorates'
        ];

        $messages = [
            'name.required' => 'اسم المحافظه مطلوب'
        ];

        $this->validate($request , $rules , $messages);

        $record = Governorate::findOrFail($id);
        $record->update($request->all());
        flash()->success('تم تحديث المحافظه بنجاح');
        return redirect(route('governorate.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $record = Governorate::findOrFail($id);
        if($record->cities()->count())
        {
            flash()->error('لا يمكن الحذف،يوجد مدن مرتبطه بهذه المحافظه');
            return back();
        }
        $record->delete();
        flash()->success('تم حذف المحافظه بنجاح');
        return redirect(route('governorate.index'));

    }

    public function search(Request $request)
    {

        $governorates = Governorate::where('name' , $request->name)->get();

        return view('governorates.governorate-search' , compact('governorates'));
    }
}
