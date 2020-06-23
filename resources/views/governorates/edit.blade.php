@extends('layouts.app')
@section('title')
    تعديل المحافظه
@stop


@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">


            <div class="box-body">
                <hr>

                @include('flash::message')

                {!! Form::model($model , [
                    'action' => ['GovernorateController@update' , $model->id],
                    'method' => 'put'
                ]) !!}

                @include('partials.validation_errors')
                @include('governorates.form')

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->

    </section>
@endsection


