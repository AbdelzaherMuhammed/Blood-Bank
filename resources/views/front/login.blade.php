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
            @include('partials.validation_errors')
            {!! Form::open([
                'url' => route('client-submit'),
                'class'=> 'w-75 mx-auto my-5'
            ]) !!}

            {!! Form::text('phone' , null , [
                        'class'       => 'form-control my-3',
                        'placeholder' => 'الجوال'
            ]) !!}

            {!! Form::password('password' , [
                        'class'       => 'form-control my-3',
                        'placeholder' => 'كلمة المرور'
            ]) !!}

            <div class="form-check float-right my-4">
                <input class="form-check-input" type="checkbox" checked value="" id="defaultCheck2">
                <label class="form-check-label" for="defaultCheck2">
                    تذكرنى
                </label>
            </div>
            <div class="float-left my-4"><a href="{{route('forget-password')}}"><i class="fas fa-exclamation-triangle px-2"></i><span>هل نسيت كلمة المرور</span></a>
            </div>
            <div class="clr"></div>
            <div class="form-row my-4">
                <div class="col">
                    <button type="submit" class="form-control py-3 bg-success text-white">دخول</button>
                </div>
                <div class="col">
                    <a href="{{route('client-register')}}" type="submit" class="form-control text-center py-3 bg">انشاء حساب جديد</a>
                </div>
            </div>
            </form>
        </section>
    </div>

@endsection
