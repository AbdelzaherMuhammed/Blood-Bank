@extends('layouts.app')

@section('title')
    التحكم في المحافظات
@stop

@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-body">
                <form action="{{url(route('governorate-search'))}}" method="get" class="form-control-static">

                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <button type="submit" class="btn btn-primary"
                                    style="width: 200px;position:absolute;right: 30px"> ابحث <i
                                    class="fa fa-search"></i>
                            </button>
                        </div>

                        <div class="col-xs-6 col-md-6">
                            {!! Form::text('name' ,null,[
                                 'class' => 'form-control',
                                 'placeholder' => 'ابحث',
                             ]) !!}
                        </div>

                    </div>
                </form>
            </div>

            <div>
                <a href="{{route('governorate.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة
                    محافظة جديده</a>
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
                            <td class="text-center">تعديل</td>
                            <td class="text-center">حذف</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$record->name}}</td>
                                <td class="text-center">
                                    <a href="{{url(route('governorate.edit' ,$record->id))}}"
                                       class="btn btn-success btn-xs">
                                        <i class="fa fa-edit"></i></a>
                                </td>
                                <td class="text-center">

                                    {!! Form::open([
                                        'action' => ['GovernorateController@destroy' , $record->id],
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




