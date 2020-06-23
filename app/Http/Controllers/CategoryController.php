<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $records = Category::all();
        return view('categories.index' , compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('categories.create');
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
            'name' => 'required|unique:categories'
        ];

        $messages = [
            'name.required' => 'الاسم مطلوب'
        ];

        $this->validate($request , $rules ,$messages );

        $records = Category::create($request->all());

        flash()->success('تمت الاضافه بنجاح');
        return redirect(route('category.index'));
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
        $model = Category::findOrFail($id);
        return view('categories.edit' , compact('model'));
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
            'name' => 'required|unique:categories'
        ];

        $messages = [
            'name.required' => 'الاسم مطلوب'
        ];

        $this->validate($request , $rules ,$messages );

        $record = Category::findOrFail($id);
        $record->update($request->all());
        flash()->success('تم التعديل بنجاح');
        return redirect(route('category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $record = Category::findOrFail($id);
        $record->delete();
        flash()->success('تم الحذف بنجاح');
        return redirect(route('category.index'));
    }

    public function search(Request $request)
    {

        $categories = Category::where('name' , $request->name)->get();

        return view('categories.category-search' , compact('categories'));
    }
}
