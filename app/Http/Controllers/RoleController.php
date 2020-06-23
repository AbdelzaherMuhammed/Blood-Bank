<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $records = Role::paginate(10);
        return view('roles.index' , compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('roles.create');
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
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'permissions_list' => 'required|array'
        ];

        $messages = [
            'name.required' => 'اسم الرتبه مطلوب',
            'name.unique' => 'قيمة الرتبه مستخدمه من قبل',
            'display_name.required' => 'الاسم المعروض مطلوب',
            'permissions_list.required' => 'الرتبة مطلوبه'
        ];

        $this->validate($request , $rules , $messages);

        $records = Role::create($request->all());
        $records->permissions()->attach($request->permissions_list);

        flash()->success('تم اضافة الرتبة بنجاح');
        return redirect(route('role.index'));
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

        $model = Role::findOrFail($id);
        return view('roles.edit' , compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request, $id)
    {

        $rules = [
            'name' => 'required|unique:roles,name,' .$id ,
            'display_name' => 'required',
            'permissions_list' => 'required|array'
        ];

        $messages = [
            'name.required' => 'اسم الرتبه مطلوب',
            'name.unique' => 'قيمة الرتبه مستخدمه من قبل',
            'display_name.required' => 'الاسم المعروض مطلوب',
            'permissions_list.required' => 'الرتبة مطلوبه'
        ];

        $this->validate($request , $rules , $messages);

        $record = Role::findOrFail($id);
        $record->update($request->all());
        $record->permissions()->sync($request->permissions_list);
        flash()->success('تم التحديث بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $record = Role::findOrFail($id);
        $record->delete();
        flash()->success('تم الحذف بنجاح');
        return redirect(route('role.index'));
    }
}
