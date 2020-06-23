<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{


    public function search(Request $request)
    {


        $records = Post::where(function ($query) use($request){
            if($request->input('title'))
            {
                $query->where('title',$request->title);
            }
            if ($request->input('category_id'))
            {
                return $query->where('category_id' , $request->category_id);
            }

        })->get();

     return view('posts.post-search' , compact('records'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $records = Post::all();
        return view('posts.index' , compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('posts.create');
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
            'title'  => 'required|unique:posts,title',
            'image'  => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content'=> 'required',
            'small_desc'=> 'required',
            'category_id' => 'required|exists:categories,id'

        ];

        $messages = [
            'title.required' => 'العنوان مطلوب',
            'title.unique' => 'قيمة العنوان مستخدمه من قبل',
            'image.required' => 'الصوره مطلوبه',
            'image.image' => 'الصوره يحب ان تكون صوره',
            'image.mimes' => 'الصوره يجب ان تكون احد هذه الانواع : jpeg,png,jpg,gif ',
            'content.required' => 'المحتوي مطلوب',
            'small_desc.required' => 'الوصف السريع مطلوب',
            'category_id.required' => 'القسم مطلوب'
        ];

        $this->validate($request , $rules , $messages );

        $records = Post::create($request->all());

        if ($request->hasFile('image')) {
            $path = public_path();
            $destinationPath = $path . '/images'; // upload path
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $image->move($destinationPath, $name); // uploading file to given path
            $records->image =   'images/' . $name ;
            $records->save();
        }

        flash()->success('تم اضافة المقاله بنجاح');
        return redirect(route('post.index'));
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
        $model = Post::findOrFail($id);
        return view('posts.edit',compact('model'));

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
            'title'  => 'unique:posts,title,' . $id,
            'image'  => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'small_desc'=> 'required',
            'content'=> 'required',
            'category_id' => 'required|exists:categories,id'

        ];
        $messages = [
            'title.required' => 'العنوان مطلوب',
            'title.unique' => 'قيمة العنوان مستخدمه من قبل',
            'image.required' => 'الصوره مطلوبه',
            'image.image' => 'الصوره يحب ان تكون صوره',
            'image.mimes' => 'الصوره يجب ان تكون احد هذه الانواع : jpeg,png,jpg,gif ',
            'content.required' => 'المحتوي مطلوب',
            'small_desc.required' => 'الوصف السريع مطلوب',
            'category_id.required' => 'القسم مطلوب'
        ];

        $this->validate($request , $rules , $messages );

        $record = Post::findOrFail($id);
        $record->update($request->all());

        if ($request->hasFile('image')) {
            $path = public_path();
            $destinationPath = $path . '/images'; // upload path
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $image->move($destinationPath, $name); // uploading file to given path
            $record->image = 'images/' . $name;
            $record->save();
        }
        flash()->success('تم تعديل المقاله بنجاح');
        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $record = Post::findOrFail($id);
        $record->delete();
        flash()->success('تم حذف المقاله بنجاح');
        return redirect(route('post.index'));
    }

}
