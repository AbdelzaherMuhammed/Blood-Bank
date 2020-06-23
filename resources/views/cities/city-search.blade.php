@extends('layouts.app')
@inject('governorate' , 'App\Models\Governorate' )
@section('title')
    التحكم في المدن
@stop

@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">

            @include('flash::message')
            @if(count($records))
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>الاسم</td>
                            <td>المحافظة</td>
                            <td class="text-center">تعديل</td>
                            <td class="text-center">حذف</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$record->name}}</td>
                                <td>{{$record->governorate->name}}</td>
                                <td class="text-center">
                                    <a href="{{url(route('city.edit' , $record->id))}}"
                                       class="btn btn-success btn-xs">
                                        <i class="fa fa-edit"></i></a>
                                </td>
                                <td class="text-center">

                                    {!! Form::open([
                                        'action' => ['CityController@destroy' , $record->id],
                                        'method' => 'delete'
                                    ]) !!}

                                    <button type="submit" class="btn-danger btn-xs"><i class="fa fa-trash"></i>
                                    </button>


                                    {!! Form::close() !!}

                                </td>
                            </tr>

                        </tbody>
                        @endforeach

                    </table>

                </div>


            @else

                <div class="alert alert-danger" role="alert">
                    لا يوجد بيانات
                </div>
            @endif
        </div>
        <!-- /.box-body -->

        </div>
        <!-- /.box -->

    </section>

@endsection




