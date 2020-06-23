@extends('front.master')
@section('content')

        <ul  style="list-style-type:none;position:absolute;left:250px;top:19px;">
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
                <form action="{{url(route('donation-search'))}}" method="get" class="form-control-static">
                    <div class="selection w-75 d-flex mx-auto my-4">
                        <select name="bloodType" class="custom-select">
                            <option disabled  selected>اختر فصيلة الدم</option>
                            @inject('bloodTypes' , 'App\Models\BloodType' )
                            @foreach($bloodTypes->all() as $bloodType)
                                <option value="{{$bloodType->id}}">{{$bloodType->name}}</option>
                            @endforeach
                        </select>
                        <select name="city" class="custom-select mx-md-3 mx-sm-1">
                            <option  disabled selected>اختر المدينة</option>
                            @inject('cities' , 'App\Models\City' )
                            @foreach($cities->take(10)->get() as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>

                        <button type="submit" style="border: none"><i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
                <!--End selection-->

                @foreach($donations as $donation)
                <div class="req-item my-3">
                    <div class="row">
                        <div class="col-md-9 col-sm-12 clearfix">
                            <div class="blood-type m-1 float-right">
                                <h3>+{{$donation->BloodType->name}}</h3>
                            </div>
                            <div class="mx-3 float-right pt-md-2">
                                <p>
                                    اسم الحالة : {{$donation->patient_name}}
                                </p>
                                <p>
                                    مستشفى : {{$donation->hospital_name}}
                                </p>
                                <p>
                                    المدينة : {{$donation->city->name}}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 text-center p-sm-3 pt-md-5">
                            <a href="{{url('donation-details' ,$donation->id)}}" class="btn btn-light px-5 py-3">التفاصيل</a>
                        </div>
                    </div>
                </div>
                @endforeach

                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center my-3">
                        <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                        </li>
                        {!! $donations->render() !!}
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>

                    </ul>
                </nav>
            </div>
            <!--End container-->
        </div>
        <!--End Donation-request-->
    </section>
    <!--End Donation-->
@endsection
