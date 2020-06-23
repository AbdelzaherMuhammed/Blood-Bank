@extends('front.master')

@section('content')
    <!--End Nav-->
    <!--main-header-->
    <div class="main-header">
        <div class="slide">
            <img src="{{asset('front/imgs/header.jpg')}}" class="d-block w-100" alt="...">
            <div class="slick-caption">
                <h4 class="my-md-3">{{$settings->small_desc}}</h4>
                <p class="pl-md-5">{{$settings->about_app}}
                </p>
                <button class="btn bg px-5">المزيد</button>
            </div>
        </div>
        <div class="slide">
            <img src="{{asset('front/imgs/header.jpg')}}" class="d-block w-100" alt="...">
            <div class="slick-caption">
                <h4 class="my-md-3">{{$settings->small_desc}}</h4>
                <p class="pl-md-5">{{$settings->about_app}}
                </p>
                <button class="btn bg px-5">المزيد</button>
            </div>
        </div>
        <div class="slide">
            <img src="{{asset('front/imgs/header.jpg')}}" class="d-block w-100" alt="...">
            <div class="slick-caption">
                <h4 class="my-md-3">{{$settings->small_desc}}</h4>
                <p class="pl-md-5">{{$settings->about_app}}
                </p>
                <button class="btn bg px-5">المزيد</button>
            </div>
        </div>
    </div>
    <!--End main-header-->

    <!--End Header-->
    <!--About section-->
    <section class="about py-5">
        <div class="container">
            <div class="about-cont py-3">
                <p class="pl-4"><span> بنك الدم </span>{{$settings->long_desc}}
                </p>
            </div>
        </div>
        <!--End container-->
    </section>
    <!--End About-->
    <!--Articles section-->
    <section class="articles py-5">
        <div class="title">
            <div class="container">
                <h2><span class="py-1">المقالات</span></h2>
            </div>
            <hr/>
        </div>
        <div class="article-slide mt-3">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="arrow text-left">
                            <button type="button" class="prev-arrow px-2 py-1"><i
                                    class="fas fa-chevron-right"></i></button>
                            <button type="button" class="next-arrow px-2 py-1"><i
                                    class="fas fa-chevron-left"></i></button>
                        </div>
                    </div>
                </div>

                <div class="slick2">
                    @inject('posts' , 'App\Models\Post' )
                    @foreach($posts->take(10)->get() as $post)
                        <div class="slick-cont">

                            <div class="card">
                                <div class="heart-icon"><i id="{{$post->id}}" onclick="toggleFavourite(this)" class="far fa-heart"></i></div>
                                <img src="{{asset($post->image)}}" class="card-img-top" alt="slick-img" width="300px "
                                     height="200px">
                                <div class="card-body">
                                    <h5 class="card-title">{{$post->title}}</h5>
                                    <p>{{$post->small_desc}}</p>
                                    <div class="text-center"><a href="{{route('post-details' , $post->id)}}"
                                        class="btn bg px-5">التفاصيل</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>
        </div>

        <!--End container-->
    </section>
    <!--End Articles-->
    <!--Donation-->
    <section class="donation">
        <h2 class="text-center"><span class="py-1">طلبات التبرع</span></h2>
        <hr/>
        <div class="donation-request py-5">
            <div class="container">
                @if(count($records))


                <!--End selection-->
                <div id="donations">

                    @foreach($records as $record)
                    <div class="req-item my-3">
                        <div class="row">

                                <div class="col-md-9 col-sm-12 clearfix">
                                    <div class="blood-type m-1 float-right"><h3>{{$record->BloodType->name}}</h3></div>
                                    <div class="mx-3 float-right pt-md-2"><p>اسم الحالة : {{$record->patient_name}}</p>
                                        <p>مستشفى : {{$record->hospital_name}}</p>
                                        <p>المدينة : {{$record->city->name}}</p></div>
                                </div>
                                <div class="col-md-3 col-sm-12 text-center p-sm-3 pt-md-5"><a
                                        href="{{route('donation-details' , $record->id)}}"
                                        class="btn btn-light px-5 py-3">التفاصيل</a>
                                </div>
                        </div>

                    </div>
                    @endforeach
                </div>
                @else
                        <div class="alert alert-danger" role="alert">
                            لا يوجد بيانات مطابقه للبحث
                        </div>

                @endif
            <!--End last req-item-->
            </div>

            <!--End container-->
        </div>
        <!--End Donation-request-->
    </section>
    <!--End Donation-->
    <!--Contact-us-->
    <section class="contact-us py-5 mt-4">
        <div class="container">
            <div class="row">
                <div class="contact-info col-md-6 col-sm-12 text-center">
                    <h4 class="text-center"><span class="brd">اتصل بنا </span></h4>
                    <p class="my-5">يمكنك الأتصال بنا للاستفسار عن معلومة وسيتم الرد عليكم</p>
                    <div class="phone-nm mx-auto">
                        <p class="text-right" href=""> {{$settings->whatsapp}}</p>
                        <img src="{{asset('front/imgs/whats.png')}}" alt="whats-phone">
                    </div>
                </div>
            </div>
        </div>
        <!--End container-->
    </section>
    <!--End Contact-us-->
    <!--blood-app-->
    <section class="blood-app py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="mt-5 mb-4">تطبيق بنك الدم</h4>
                    <p class="appText">{{$settings->app_message}}</p>
                    <div class="text-center avilb">
                        <h5 class="my-4">متوفر على</h5>
                        <img  src="{{asset('front/imgs/google.png')}}" alt="">
                        <img  src="{{asset('front/imgs/ios.png')}}" alt="">
                    </div>
                </div>
                <div class="col-md-6 my-3"><img src="{{asset('front/imgs/App.png')}}" class="img-fluid" alt=""></div>
            </div>
            <!--End row-->
        </div>
        <!--End container-->
    </section>
    @push('scripts')
        <script>
            function toggleFavourite(heart){
                var post_id = heart.id;
                alert(post_id)
                $.ajax({
                    url : '{{url(route('toggle-favourite'))}}',
                    type: 'post',
                    data : { _token : "{{csrf_token()}}" , post_id : post_id },
                    success :function (data) {
                        console.log(data);
                    }
                })
                var currentClass = $(heart).attr('class');
                if (currentClass.includes('first')){
                    $(heart).removeClass('first-heart').addClass('second-heart');
                }else{
                    $(heart).removeClass('second-heart').addClass('first-heart');
                }
            }
        </script>
    @endpush
    <!--End blood-app-->
@stop

