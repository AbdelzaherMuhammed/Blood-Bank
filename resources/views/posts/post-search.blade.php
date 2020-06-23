@extends('layouts.app')

@section('title')
    البحث في المقالات
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
                                <td>العنوان</td>
                                <td>الصوره</td>
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



