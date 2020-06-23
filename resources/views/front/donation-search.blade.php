@extends('front.master')
@section('content')

        <ul style="list-style-type:none;position:absolute;left:250px;top:19px;">
            <li  class="mr-lg-auto py-md-5"><a class="btn bg" href="{{route('donation-request')}}">انشاء طلب تبرع</a></li>
        </ul>

        <div class="container">
        <!--Breadcrumb-->
        <nav class="my-5" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active" aria-current="page">طلبات التبرع</li>
            </ol>
        </nav>
    </div><!--End container-->
    <!--Donation-->
    <section class="donation">
        <h2 class="text-center"><span class="py-1">طلبات التبرع</span> </h2>
        <hr />
        <div class="donation-request py-5">
            <div class="container">


                @foreach($records as $record)
                <div class="req-item my-3">
                    <div class="row">
                        <div class="col-md-9 col-sm-12 clearfix">
                            <div class="blood-type m-1 float-right">
                                <h3>{{$record->BloodType->name}}</h3>
                            </div>
                            <div class="mx-3 float-right pt-md-2">
                                <p>
                                    اسم الحالة : {{$record->patient_name}}
                                </p>
                                <p>
                                    مستشفى : {{$record->hospital_name}}
                                </p>
                                <p>
                                    المدينة : {{$record->city->name}}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 text-center p-sm-3 pt-md-5">
                            <a href="{{url('donation-details' ,$record->id)}}" class="btn btn-light px-5 py-3">التفاصيل</a>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
            <!--End container-->
        </div>
        <!--End Donation-request-->
    </section>
    <!--End Donation-->
@endsection
