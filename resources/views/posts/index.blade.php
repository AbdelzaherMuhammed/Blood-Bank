@extends('layouts.app')
@inject('category' ,'App\Models\Category')
@section('title')
    التحكم في المقالات
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
                <form action="{{url(route('post-search'))}}" method="get" class="form-control-static">

                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <button type="submit" class="btn btn-primary"
                                    style="width: 200px;position:absolute;right: 30px"> ابحث <i
                                    class="fa fa-search"></i>
                            </button>
                        </div>

                        <div class="col-xs-6 col-md-4">
                            {!! Form::text('title' ,null,[
                                'class' => 'form-control',
                                'placeholder' => 'ابحث',

                        ]) !!}
                        </div>
                        <div class="col-xs-6 col-md-4"> {!! Form::select('category_id',$category->pluck('name','id')->toArray(),null,[
                            'class' => 'form-control',
                            'placeholder' => 'اختر المقاله',
                        ]) !!}
                        </div>
                    </div>
                </form>
            </div>


            <div>
                <a href="{{route('post.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة مقاله
                    جديده</a>
            </div>
            <br>
            <hr>
            @include('flash::message')
            @if(count($records))
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>العنوان</td>
                            <td>الصوره</td>
                            <td>وصف سريع</td>
                            <td>المحتوي</td>
                            <td>القسم</td>
                            <td class="text-center">تعديل</td>
                            <td class="text-center">حذف</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$record->title}}</td>
                                <td><img src="{{asset($record->image)}}" alt=""
                                         width="100px" height="50px" style="border-radius: 40%">
                                </td>
                                <td>{{$record->small_desc}}</td>
                                <td>{{$record->content}}</td>
                                <td>{{$record->category->name}}</td>
                                <td class="text-center">
                                    <a href="{{url(route('post.edit' ,$record->id))}}"
                                       class="btn btn-success btn-xs">
                                        <i class="fa fa-edit"></i></a>
                                </td>
                                <td class="text-center">

                                    {!! Form::open([
                                        'action' => ['PostController@destroy' , $record->id],
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

            @endif
        </div>
        <!-- /.box-body -->

        </div>
        <!-- /.box -->

    </section>


@endsection



