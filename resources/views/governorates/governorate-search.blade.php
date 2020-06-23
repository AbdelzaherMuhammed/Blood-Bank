@extends('layouts.app')

@section('title')
    التحكم في المحافظات
@stop

@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">


            @include('flash::message')
            @if(count($governorates))
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>الاسم</td>
                            <td class="text-center">تعديل</td>
                            <td class="text-center">حذف</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($governorates as $governorate)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$governorate->name}}</td>
                                <td class="text-center">
                                    <a href="{{url(route('governorate.edit' ,$governorate->id))}}"
                                       class="btn btn-success btn-xs">
                                        <i class="fa fa-edit"></i></a>
                                </td>
                                <td class="text-center">

                                    {!! Form::open([
                                        'action' => ['GovernorateController@destroy' , $governorate->id],
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




