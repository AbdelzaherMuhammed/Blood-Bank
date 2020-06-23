@extends('layouts.app')
@section('title')
    تعديل الاعدادات
@stop


@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">


            <div class="box-body">
                <hr>

                @include('flash::message')

                {!! Form::model($model , [
                    'action' => ['SettingsController@update' , $model->id],
                    'method' => 'put'
                ]) !!}

                @include('partials.validation_errors')
                @include('settings.form')

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->

    </section>
@endsection


