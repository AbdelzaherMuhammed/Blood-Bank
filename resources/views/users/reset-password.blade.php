@extends('layouts.app')
@section('title')
    تعديل كلمة المرور
@stop


@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                @include('flash::message')

                {!! Form::open([
                  'action' => 'UserController@updatePassword',
              ]) !!}
                @include('partials.validation_errors')

                <div class="form-group">
                    <div class="col-md-12">
                        <label for="name">كلمة المرور الحاليه</label><br>
                        {!! Form::password('old-password',[
                            'class' =>'form-control'
                        ]) !!}
                    </div>
                </div>
                <div class="clearfix"></div>
                <br>

                <div class="form-group">
                    <div class="col-md-12">
                        <label for="name">كلمة المرور الجديده</label><br>
                        {!! Form::password('password',[
                            'class' =>'form-control'
                        ]) !!}
                    </div>
                </div>
                <div class="clearfix"></div>
                <br>

                <div class="form-group">
                    <div class="col-md-12">
                        <label for="name">تاكيد كلمة المرور الجديده</label><br>
                        {!! Form::password('password_confirmation',[
                            'class' =>'form-control'
                        ]) !!}
                    </div>
                </div>

                <div class="clearfix"></div>
                <br>

                <div class="form-group">
                    <div class="col-md-12">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>

                {!! Form::close() !!}

            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->

    </section>







@endsection


