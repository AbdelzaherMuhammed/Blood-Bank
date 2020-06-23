@extends('layouts.app')

@section('title')
    التحكم في التبرعات
@stop

@section('content')

    <section class="content">

        <!-- Default box -->

        <div class="box">

            <div class="box-body">
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
                        لا يوجد بيانات
                    </div>
            </div>

        @endif
        <!-- /.box-body -->


        </div>
        <!-- /.box -->

        <!-- /.content -->

    </section>

@endsection




