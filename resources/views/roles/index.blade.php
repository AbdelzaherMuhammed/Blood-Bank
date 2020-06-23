@extends('layouts.app')

@section('title')
    التحكم في رتب المستخدمين
@stop

@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div>
                <a href="{{route('role.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة رتبه جديدة</a>
                </div>
                <br>

                @include('flash::message')
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td>#</td>
                                <td>الاسم</td>
                                <td>الاسم المعروض</td>

                                <td class="text-center">تعديل</td>
                                <td class="text-center">حذف</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$record->name}}</td>
                                    <td>{{$record->display_name}}</td>
                                    <td class="text-center">
                                        <a href="{{url(route('role.edit' ,$record->id))}}"
                                           class="btn btn-success btn-xs">
                                            <i class="fa fa-edit"></i></a>
                                    </td>

                                    <td class="text-center">
                                        {!! Form::open([
                                            'action' => ['RoleController@destroy' , $record->id],
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
                        عفوا ، لا يوجد بيانات
                    </div>
                @endif
            </div>

        </div>
        <!-- /.box -->

    </section>

@endsection


