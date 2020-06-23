@extends('layouts.app')
@section('title')
    تعديل الرتبه
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
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @include('flash::message')

                {!! Form::model($model , [
                    'action' => ['RoleController@update' , $model->id],
                    'method' => 'put'
                ]) !!}

                @include('partials.validation_errors')
                @include('roles.form')

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>

@endsection


