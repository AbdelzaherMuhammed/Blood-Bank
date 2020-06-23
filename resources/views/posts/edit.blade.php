@extends('layouts.app')
@section('title')
    تعديل المقاله
@stop


@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">


            <div class="box-body">
                @include('flash::message')

                {!! Form::model($model , [
                    'action' => ['PostController@update' , $model->id],
                    'files'  => 'true',
                    'method' => 'put',

                ]) !!}

                @include('partials.validation_errors')
                @include('posts.form')

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->

    </section>
@endsection





