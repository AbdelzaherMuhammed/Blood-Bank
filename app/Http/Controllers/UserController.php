<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function changePassword()
    {
        return view('users.reset-password');
    }

    public function updatePassword(Request $request)
    {
        $rules = [
            'old-password' => 'required',
            'password'     => 'required|confirmed'
        ];

        $messages = [
            'old-password' => 'كلمة المرور الحاليه مطلوبه',
            'password'     => 'كلمة المرور مطلوبه'
        ];

        $this->validate($request , $rules , $messages);

        $user = auth()->user();

        if(Hash::check($request->input('old-password') , $user->password)){
            $user->password = bcrypt($request->input('password'));

            $user->save();

            flash()->success('تم تغيير كلمة المرور بنجاح');

        }else
        flash()->error('كلمة المرور غير صحيحه');
        return view('users.reset-password');

    }
    public function search(Request $request)
    {


        $records = User::where(function ($query) use($request){
            if($request->has('name'))
            {
                $query->where('name',$request->name)
                ->orWhere('email' , $request->name);
            }
        })->get();

        return view('users.user-search' , compact('records'));
    }








    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $records = User::paginate(20);
        return view('users.index' , compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'      => 'required',
            'password'  => 'required|confirmed',
            'email'     => 'required|email',
            'roles_list'=> 'required'
        ];

        $this->validate($request , $rules);

        $request->merge(['password' => bcrypt('password')]);
        $record = User::create($request->except('roles_list'));
        $record->roles()->attach($request->input('roles_list'));

        flash()->success('تم اضافة المستخدم بنجاح');
        return redirect(route('user.index'));



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
        $model = User::findOrFail($id);
        return view('users.edit' , compact('model'));
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
            'name'      => 'required',
            'password'  => 'confirmed',
            'email'     => 'required|email',
            'roles_list'=> 'required'
        ];

        $this->validate($request , $rules);

        $request->merge(['password' => bcrypt('password')]);

        $record = User::findOrFail($id);

        $record->roles()->sync((array) $request->input('roles_list'));

        $record->update($request->all());

        flash()->success('تم التحديث بنجاح');

        return redirect(route('user.edit' , $id));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = User::findOrFail($id);

        $record->delete();

        return redirect(route('user.index'));

    }
}
