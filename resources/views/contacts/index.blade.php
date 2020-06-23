@extends('layouts.app')

@section('title')
       اتصل بنا
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
                                <td>البريد الالكتروني</td>
                                <td>التليفون</td>
                                <td>الموضوع</td>
                                <td>الرساله</td>
                                <td class="text-center">حذف</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$record->email}}</td>
                                    <td>{{$record->phone}}</td>
                                    <td>{{$record->subject}}</td>
                                    <td>{{$record->message}}</td>

                                    <td class="text-center">

                                        {!! Form::open([
                                            'action' => ['ContactController@destroy' , $record->id],
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
                        No data Found
                    </div>
            </div>
        @endif
            <!-- /.box-body -->


        </div>
        <!-- /.box -->

        <!-- /.content -->

    </section>

@endsection




