@extends('front.master')
@section('content')
    <div class="container">
        <!--Breadcrumb-->
        <nav class="my-5" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active" aria-current="page">تسجيل الدخول</li>
            </ol>
        </nav><!--End Breadcrumb-->
        <section class="signup-form my-4 py-4">
            <div class="my-5 text-center"><img src="{{asset('front/imgs/logo.png')}}" alt="logo"></div>

            @include('flash::message')
            {!! Form::open([
                'url' => route('reset-password'),
                'class'=> 'w-75 mx-auto my-5'
            ]) !!}

            {!! Form::text('phone' , null , [
                        'class'       => 'form-control my-3',
                        'placeholder' => 'الجوال'
            ]) !!}





            <div class="form-row my-4">
                <div class="col">
                    <button type="submit" class="form-control py-3 bg-success text-white">ارسال</button>
                </div>

            </div>

        </section>
    </div>

@endsection
