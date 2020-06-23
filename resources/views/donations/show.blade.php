@extends('layouts.app')

@section('title')
    تفاصيل حالة تبرع
    {{$records->patient_name}}
@stop

@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-body">

                <div class="container">
                    <div class="box">
                        <div class="content">
                            <ul>
                                <li>الاسم : {{$records->patient_name}} </li>
                                <hr>

                                <li>التليفون : {{$records->patient_phone}}</li>
                                <hr>

                                <li>العمر : {{$records->patient_age}}</li>
                                <hr>

                                <li>عدد الأكياس المطلوبه : {{$records->bags_num}}</li>
                                <hr>

                                <li>فصيلة الدم : {{$records->BloodType->name}}</li>
                                <hr>

                                <li>اسم المستشفي : {{$records->hospital_name}}</li>
                                <hr>

                                <li>العنوان : {{$records->hospital_address}}</li>
                                <hr>

                                <li>التفاصيل : {{$records->details}}</li>
                                <hr>

                                <li>المدينه : {{$records->city->name}}</li>
                                <hr>

                                <li>العميل : {{$records->client->name}}</li>
                                <hr>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection




