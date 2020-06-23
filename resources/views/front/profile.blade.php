@extends('front.master')

@section('content')
    <div class="container">
        <!--Breadcrumb-->
        <nav class="my-4" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active" aria-current="page">البيانات الشخصيه ل {{auth()->guard('client-web')->user()->name}}</li>
            </ol>
        </nav><!--End Breadcrumb-->
    </div><!--End container-->
    <section class="signup text-center">
        <div class="container">
            <div class="py-4 mb-4">
                @include('flash::message')
                    {!! Form::model($profile ,[
                        'action'    => ['Front\MainController@profileUpdate' , $profile->id],

                    ]) !!}
                @include('partials.validation_errors')
                @include('clients.form')


                {!! Form::close() !!}
            </div>
        </div>
    </section>

@endsection



