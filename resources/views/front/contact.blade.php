@extends('front.master')
@section('content')
    <div class="container">
        <!--Breadcrumb-->
        <nav class="my-4" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active" aria-current="page">اتصل بنا</li>
            </ol>
        </nav><!--End Breadcrumb-->
    </div><!--End container-->
    <section class="contact py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 my-1">
                    <div class="contact-details">
                        <h5 class="py-3 text-center">اتصل بنا</h5>
                        <div class="text-center py-3"><img src="{{asset('front/imgs/logo.png')}}" alt="img-logo"></div>
                        <div class="contact-mail p-3">
                            <p class="py-1">الجوال <span> : {{$settings->phone}}</span></p>
                            <p class="py-1">فاكس <span> : 4123412</span></p>
                            <p class="py-1">البريد الاليكترونى <span> : {{$settings->email}}</span></p>
                        </div>
                        <div class="contact-social text-center">
                            <h6 class="py-2"> تواصل معنا</h6>
                            <ul class="list-unstyled d-flex justify-content-center py-md-3">
                                <li class="mx-2"><a class="insta" href="{{$settings->inst_link}}"><i class="fab fa-instagram"></i></a></li>
                                <li class="mx-2"><a class="youtube" href="{{$settings->youtube_link}}"><i class="fab fa-youtube-square"></i></a></li>
                                <li class="mx-2"><a class="twitter" href="{{$settings->tw_link}}"><i class="fab fa-twitter-square"></i></li>
                                <li class="mr-2"><a class=" facebook" href="{{$settings->fb_link}}"><i class="fab fa-facebook-square"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="contact-form text-center">
                        <h5 class="py-3">تواصل معنا</h5>
                        {!! Form::open([
                                'action' => 'Front\MainController@contactSend',
                           ]) !!}
                            @include('partials.validation_errors')
                            @include('flash::message')

                            {!! Form::text('phone' , null , [
                                 'class'       => 'form-control my-3',
                                 'placeholder' => 'الجوال'
                             ]) !!}

                            {!! Form::text('email' , null , [
                                 'class'       => 'form-control my-3',
                                 'placeholder' => 'البريد الالكتروني'
                             ]) !!}
                            {!! Form::text('subject' , null , [
                                 'class'       => 'form-control my-3',
                                 'placeholder' => 'عنوان الرساله'
                             ]) !!}
                            {!! Form::textarea('message' , null , [
                                 'class'       => 'form-control my-3',
                                 'placeholder' => 'نص الرساله',
                                 'rows'        => 8
                             ]) !!}

                            <button type="submit" class="btn py-3 bg w-100 ">ارسال</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
