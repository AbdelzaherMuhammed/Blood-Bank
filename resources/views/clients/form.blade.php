@inject('city' , 'App\Models\City')
@inject('blood_type' , 'App\Models\BloodType')

<div class="form-group">

    <label style="float: right" for="phone">الموبايل</label>
    {!! Form::text('phone',null,[
        'class' =>'form-control'
    ]) !!}

    <br>

    <label style="float: right" for="name">الاسم</label>
    {!! Form::text('name',null,[
        'class' =>'form-control'
    ]) !!}

    <br>

    <label style="float: right" for="email">البريد الالكتروني</label>
    {!! Form::email('email',null,[
        'class' =>'form-control'
    ]) !!}

    <br>



            <label style="float: right" for="password">كلمة المرور</label><br>
            {!! Form::password('password',[
                'class' =>'form-control'
            ]) !!}

        <br>
            <label style="float: right" for="password">تاكيد كلمة المرور</label><br>
            {!! Form::password('password_confirmation',[
                'class' =>'form-control'
            ]) !!}


    <br>
    <label style="float: right" for="date_of_birth">تاريخ الميلاد</label>
    {!! Form::date('date_of_birth',null,[
        'class' =>'form-control'
    ]) !!}

    <br>

    <label style="float: right" for="last_donation_date">تاريخ اخر تبرع</label>
    {!! Form::date('last_donation_date',null,[
        'class' =>'form-control'
    ]) !!}

    <br>

    <label  style="float: right" for="city_id">المدينه</label>
    {!! Form::select('city_id',$city->pluck('name' , 'id')->toArray() , null,[
        'class' =>'form-control',
        'placeholder' => 'اختر مدينتك'
    ]) !!}

    <br>

    <label style="float: right" for="blood_type_id">فصيلة الدم</label>
    {!! Form::select('blood_type_id',$blood_type->pluck('name' , 'id')->toArray(),null,[
        'class' =>'form-control',
        'placeholder' => 'اختر فصيلة دمك'
    ]) !!}

    <br>

    <button class="btn btn-primary" type="submit">Submit</button>

</div>




