@extends('front.master')
@section('content')
    <div class="container">
        <!--Breadcrumb-->
        <nav class="my-5" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item"><a href="{{route('post')}}">المقالات</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$posts->title}}</li>
            </ol>
        </nav><!--End Breadcrumb-->
    </div><!--End container-->
    <section class="artice-detailes pb-5">
        <div class="container">
            <div class="article-img m-auto">
                <img src="{{asset($posts->image)}}" class="card-img-top" width="555px" height="369px" alt="article-img">
            </div>
            <div class="article-content my-4">
                <div class="article-header p-2 d-flex justify-content-between">
                    <h6>{{$posts->title}}</h6>
                    <a href=""><i class="far fa-heart"></i></a>
                </div>
                <div class="article-details p-4">
                    <p class="my-md-4">{{$posts->content}}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!--Articles section-->
    <section class="articles mb-5">
        <div class="title">
            <div class="container">
                <h5><span class="py-1">مقالات ذات صلة</span> </h5>
            </div>
        </div>
        <div class="article-slide mt-3">
            <div class="container">
                <div class="arrow text-left">
                    <button type="button" class="prev-arrow px-2 py-1"><i class="fas fa-chevron-right"></i></button>
                    <button type="button" class="next-arrow px-2 py-1"><i class="fas fa-chevron-left"></i></button>
                </div>
                <div class="slick2">
                    @foreach($posts->all() as $post)
                        <div class="slick-cont">

                            <div class="card">
                                <img src="{{asset($post->image)}}" class="card-img-top" width="300px" height="250px" alt="slick-img">
                                <div class="heart-icon"><i class="far fa-heart"></i></div>
                                <div class="card-body">
                                    <h5 class="card-title">{{$post->title}}</h5>
                                    <p>{{$post->small_desc}}
                                    </p>
                                    <div class="text-center"><a href="{{route('post-details' ,$post->id)}}"
                                                                class="btn bg px-5">التفاصيل</a></div>
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
    <!--Footer-->
@endsection
