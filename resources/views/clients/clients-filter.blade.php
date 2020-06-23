@extends('layouts.app')

@section('title')
    التحكم في الاعضاء
@stop

@section('content')

    <section class="content">

        <!-- Default box -->

        <div class="box">

            @include('flash::message')
            @if(count($clients))
                <div class="table-responsive">
                    <table class="table table-bordered" style="page-break-inside: avoid">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>الاسم</td>
                            <td>الموبايل</td>
                            <td>البريد الالكتروني</td>
                            <td>تاريخ الميلاد</td>
                            <td>تاريخ اخر تبرع</td>
                            <td>المدينه</td>
                            <td>فصيلة الدم</td>
                            <td>الحاله</td>
                            <td class="text-center">تعديل</td>
                            <td class="text-center">حذف</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$client->name}}</td>
                                <td>{{$client->phone}}</td>
                                <td>{{$client->email}}</td>
                                <td>{{$client->date_of_birth}}</td>
                                <td>{{$client->last_donation_date}}</td>
                                <td>{{$client->city->name}}</td>
                                <td>{{$client->BloodType->name}}</td>
                                <td>@if($client->status == 1)
                                        <a href="{{url(route('change-status' , $client->id))}}" class="btn btn-success">
                                            مفعل <i class="fa fa-check"></i> </a>
                                    @else
                                        <a href="{{url(route('change-status' , $client->id))}}" class="btn btn-danger">
                                            غير مفعل <i class="fa fa-times"></i> </a>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <a href="{{url(route('client.edit' ,$client->id))}}"
                                       class="btn btn-success btn-xs">
                                        <i class="fa fa-edit"></i></a>
                                </td>
                                <td class="text-center">

                                    {!! Form::open([
                                        'action' => ['ClientController@destroy' , $client->id],
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




