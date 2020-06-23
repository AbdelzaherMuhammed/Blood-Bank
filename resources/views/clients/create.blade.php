@extends('layouts.app')
@inject('client' , 'App\Models\Client')

@section('title')
    اضافة عضو جديد
@stop


@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-body">
                {!! Form::model($client , [
                      'action' => 'ClientController@store'
                  ]) !!}

                @include('partials.validation_errors')
                @include('clients.form')

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->

    </section>

@endsection


