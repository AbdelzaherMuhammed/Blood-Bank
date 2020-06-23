@extends('layouts.app')
@inject('model' , 'App\Models\DonationRequest')
@section('title')
    اضافة طلب تبرع جديد
@stop


@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-body">
                {!! Form::model($model ,[
                      'action' => 'DonationRequestController@store'
                  ]) !!}

                @include('partials.validation_errors')
                @include('donations.form')

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->

    </section>

@endsection


