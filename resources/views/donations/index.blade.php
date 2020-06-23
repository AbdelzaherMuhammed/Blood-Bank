@extends('layouts.app')

@section('title')
    التحكم في التبرعات
@stop

@section('content')

    <section class="content">

        <!-- Default box -->

        <div class="box">

            <div class="box-body">

                <div class="box-body">
                    <form action="{{ route('donation-filter') }}" method="get">
                        <div class="row">
                            <div class="col-md-12" style="margin-top:5px ">
                                <label>@lang(' تاريخ التسجيل من :')</label>
                                {!! Form::date('from',request('from'),[
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            <div class="col-md-12" style="margin-top:5px ">
                                <label>@lang(' تاريخ التسجيل الي :')</label>
                                {!! Form::date('to',request('to'),[
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            @inject('bloodType','App\Models\BloodType')
                            <div class="col-sm-3" style="margin-top: 5px">
                                {!! Form::select('blood_type_id',$bloodType->pluck('name','id')->toArray(),request('blood_type_id'),[
                                        'class' => 'form-control js-example-basic-single',
                                        'placeholder' =>'   فصيلة الدم'
                                    ]) !!}
                            </div>
                            @inject('city','App\Models\City')
                            <div class="col-sm-3" style="margin-top: 5px">
                                {!! Form::select('city_id',$city->pluck('name','id')->toArray(),request('city_id'),[
                                        'class' => 'form-control js-example-basic-single',
                                        'placeholder' =>'    المدينة'
                                    ]) !!}
                            </div>
                            @inject('govern','App\Models\Governorate')
                            <div class="col-sm-3" style="margin-top: 5px">
                                {!! Form::select('governorate_id',$govern->pluck('name','id')->toArray(),request('governorate_id'),[
                                        'class' => 'form-control js-example-basic-single',
                                        'placeholder' =>'  المحافظة'
                                    ]) !!}
                            </div>
                            @inject('clients','App\Models\Client')
                            <div class="col-sm-3" style="margin-top: 5px">
                                {!! Form::select('client_id',$clients->pluck('name','id')->toArray(),request('client_id'),[
                                        'class' => 'form-control js-example-basic-single',
                                        'placeholder' =>'  العضو'
                                    ]) !!}
                            </div>
                            <div class="col-md-6" style="margin-top:5px;position: center;left: 300px ">
                                <button type="submit" class="btn btn-primary btn-block"><i
                                        class="fa fa-search"></i> @lang('site.search')</button>
                            </div>

                        </div>
                    </form>
                </div>

                <hr>
                <div>
                    <a href="{{route('donation.create')}}" class="btn btn-primary"><i class="fa fa-plus">

                        </i> اضافة طلب تبرع جديد</a>
                    <br>
                </div>
                <br>
                @include('flash::message')
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td>#</td>
                                <td>اسم المريض</td>
                                <td>تليفون المريض</td>
                                <td>عمر المريض</td>
                                <td>عدد اكياس الدم المطلوبه</td>
                                <td>اسم المستشفي</td>
                                <td>عنوان المستشفي</td>
                                <td>التفاصيل</td>
                                <td>فصيلة الدم</td>
                                <td>المدينه</td>
                                <td>العميل</td>
                                <td>اضيف في</td>
                                <td class="text-center">عرض التفاصيل</td>
                                <td class="text-center">تعديل</td>
                                <td class="text-center">حذف</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$record->patient_name}}</td>
                                    <td>{{$record->patient_phone}}</td>
                                    <td>{{$record->patient_age}}</td>
                                    <td>{{$record->bags_num}}</td>
                                    <td>{{$record->hospital_name}}</td>
                                    <td>{{$record->hospital_address}}</td>
                                    <td>{{$record->details}}</td>
                                    <td>{{$record->BloodType->name}}</td>
                                    <td>{{$record->city->name}}</td>
                                    <td>{{$record->client->name}}</td>
                                    <td>{{$record->created_at}}</td>
                                    <td class="text-center">
                                        <a href="{{url(route('donation.show' ,$record->id))}}"
                                           class="btn btn-primary btn-xs">
                                            <i class="fa fa-plus-square"></i></a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{url(route('donation.edit' ,$record->id))}}"
                                           class="btn btn-success btn-xs">
                                            <i class="fa fa-edit"></i></a>
                                    </td>
                                    <td class="text-center">

                                        {!! Form::open([
                                            'action' => ['DonationRequestController@destroy' , $record->id],
                                            'method' => 'delete'
                                        ]) !!}

                                        <button type="submit" class=" btn-danger btn-xs"><i class="fa fa-trash"></i>
                                        </button>

                                        {!! Form::close() !!}

                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table>
                        {!! $records->render() !!}


                    </div>


                @else

                    <div class="alert alert-danger" role="alert">
                        No data Found
                    </div>
            </div>
        {{}}
        @endif
        <!-- /.box-body -->


        </div>
        <!-- /.box -->

        <!-- /.content -->

    </section>

@endsection




