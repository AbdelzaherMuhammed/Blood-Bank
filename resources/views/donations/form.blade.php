@inject('city' , 'App\Models\City')
@inject('client' , 'App\Models\Client')
@inject('blood_type' , 'App\Models\BloodType')

<div class="form-group">

    <label for="name">الاسم</label>
    {!! Form::text('patient_name',null,[
        'class' =>'form-control'
    ]) !!}
    <br>
    <label for="">الموبايل</label>
    {!! Form::text('patient_phone',null,[
        'class' =>'form-control'
    ]) !!}

    <br>
    <label for="name">العمر</label>
    {!! Form::number('patient_age',null,[
        'class' =>'form-control'
    ]) !!}

    <br>

    <label for="name">عدد اكياس الدم المطلوبه</label><br>
    {!! Form::number('bags_num',null,[
        'class' =>'form-control'
    ]) !!}

    <br>
    <label for="name">اسم المستشفي</label><br>
    {!! Form::text('hospital_name',null,[
        'class' =>'form-control'
    ]) !!}

    <br>

    <label for="name">عنوان المستشفي</label>
    {!! Form::text('hospital_address',null,[
        'class' =>'form-control'
    ]) !!}

    <br>

    <label for="name">التفاصيل</label>
    {!! Form::text('details',null,[
        'class' =>'form-control'
    ]) !!}

    <br>
    <label for="name">المدينه</label>
    {!! Form::select('city_id',$city->pluck('name' , 'id')->toArray() , null,[
        'class' =>'form-control',
        'placeholder' => 'اختر مدينتك'
    ]) !!}

    <br>

    <label for="name">فصيلة الدم</label>
    {!! Form::select('blood_type_id',$blood_type->pluck('name' , 'id')->toArray(),null,[
        'class' =>'form-control',
        'placeholder' => 'اختر فصيلة دمك'
    ]) !!}

    <br>

    <label for="name">العضو</label>
    {!! Form::select('client_id',$client->pluck('name' , 'id')->toArray(),null,[
        'class' =>'form-control',
        'placeholder' => 'العضو'
    ]) !!}
    <br>
    <button class="btn btn-primary" type="submit">تاكيد</button>

</div>


