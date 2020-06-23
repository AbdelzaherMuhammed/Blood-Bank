@extends('layouts.app')

@section('title')
    اعدادات الموقع
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
                                <td>عن الموقع</td>
                                <td><i class="fa fa-facebook-square fa-2x"></i></td>
                                <td><i class="fa fa-twitter-square fa-2x"></i></td>
                                <td><i class="fa fa-instagram fa-2x"></i></td>
                                <td><i class="fa fa-youtube-square fa-2x"></i></td>
                                <td class="text-center">الهاتف</td>
                                <td class="text-center">البريد الالكتروني</td>
                                <td class="text-center">الواتساب</td>
                                <td class="text-center">تعديل</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$record->about_app}}</td>
                                    <td><a href="{{$record->fb_link}}">Facebook</a></td>
                                    <td><a href="{{$record->tw_link}}">Twitter</a></td>
                                    <td><a href="{{$record->inst_link}}">Instagram</a></td>
                                    <td><a href="{{$record->youtube_link}}">Instagram</a></td>
                                    <td>{{$record->phone}}</td>
                                    <td>{{$record->email}}</td>
                                    <td>{{$record->whatsapp}}</td>
                                    <td class="text-center">
                                        <a href="{{url(route('setting.edit' ,$record->id))}}"
                                           class="btn btn-success btn-xs">
                                            <i class="fa fa-edit"></i></a>
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




