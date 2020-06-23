@extends('layouts.app')
@inject('model' , 'App\User')

@section('title')
    اضافة مستخدم جديد
@stop


@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-body">
                {!! Form::model($model , [
                      'action' => 'UserController@store'
                  ]) !!}

                @include('partials.validation_errors')
                @include('users.form')

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->

    </section>

@endsection


