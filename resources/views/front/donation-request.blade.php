@extends('front.master')
@inject('blood_type' , 'App\Models\BloodType')
@inject('client' , 'App\Models\Client')
@inject('cities' , 'App\Models\City')


@section('content')

    <div class="container">
        <!--Breadcrumb-->
        <nav class="my-4" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active" aria-current="page">انشاء طلب تبرع جديد</li>
            </ol>
        </nav><!--End Breadcrumb-->
    </div><!--End container-->
    <section class="signup text-center">
        <div class="container">

            <div class="py-4 mb-4">

                {!! Form::open([
                    'url'    =>route('donation-confirm'),
                    'class'     => 'form-group'
                ]) !!}

                @include('partials.validation_errors')
                <div class="form-group">
                    {!! Form::text('patient_name' , null , [
                        'class'       => 'form-control my-3',
                        'placeholder' => 'اسم المريض'
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::number('patient_phone' , null , [
                        'class'       => 'form-control my-3',
                        'placeholder' => 'رقم الهاتف'
                     ]) !!}
                </div>

                <div class="form-group">
                    {!! Form::number('patient_age' , null , [
                         'class'       => 'form-control',
                         'placeholder' => 'العمر',

                    ]) !!}

                </div>
                <div class="form-group">
                    {!! Form::number('bags_num' , null , [
                        'class'       => 'form-control my-3',
                        'placeholder' => 'عدد اكياس الدم المطلوبه',

                     ]) !!}
                </div>

                <div class="form-group">
                    {!! Form::text('hospital_name' , null , [
                        'class'       => 'form-control my-3',
                        'placeholder' => 'اسم المستشفي',

                     ]) !!}
                </div>

                <div class="form-group">
                    {!! Form::text('hospital_address' , null , [
                        'class'       => 'form-control my-3',
                        'placeholder' => 'عنوان المستشفي',

                     ]) !!}
                </div>

                <div class="form-group">
                    {!! Form::textarea('details' , null , [
                        'class'       => 'form-control my-3',
                        'placeholder' => 'التفاصيل',
                        'rows'        => 4

                     ]) !!}
                </div>
                <div class="form-group">

                    {!! Form::select('city_id' , $cities->pluck('name', 'id')->toArray() ,null ,[
                        'class' => 'form-control',
                        'id' => 'cities',
                        'placeholder' => 'اختر مدينه',
                    ]) !!}

                </div>

                <div class="form-group">

                    {!! Form::select('blood_type_id' , $blood_type->pluck('name' , 'id')->toArray() ,null , [
                         'class'       => 'form-control my-3',
                         'placeholder' => 'فصيلة الدم',
                    ]) !!}
                </div>
                <div class="form-group">

                    {!! Form::select('client_id',$client->pluck('name' , 'id')->toArray(),null,[
                         'class' =>'form-control',
                         'placeholder' => 'العضو'
                    ]) !!}
                </div>

                <button type="submit" class="btn btn-success py-2 w-50">ارسال</button>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection


