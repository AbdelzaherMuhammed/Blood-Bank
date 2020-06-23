@extends('layouts.app')
@inject('governorates' , 'App\Models\Governorate' )
@section('title')
    التحكم في المدن
@stop

@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">


            <div class="box-body">
                <form action="{{url(route('city-search'))}}" method="get" class="form-control-static">

                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <button type="submit" class="btn btn-primary"
                                    style="width: 200px;position:absolute;right: 30px"> ابحث <i
                                    class="fa fa-search"></i>
                            </button>
                        </div>

                        <div class="col-xs-6 col-md-4">
                            {!! Form::text('name' ,null,[
                                'class' => 'form-control',
                                'placeholder' => 'ابحث',

                        ]) !!}
                        </div>
                        <div class="col-xs-6 col-md-4"> {!! Form::select('governorate_id',$governorates->pluck('name','id')->toArray(),null,[
                            'class' => 'form-control',
                            'placeholder' => 'اختر المحافظه',
                        ]) !!}
                        </div>
                    </div>
                </form>
            </div>

            <div>
                <a href="{{route('city.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة مدينه جديده</a>
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
                    {!! $records->render() !!}

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




