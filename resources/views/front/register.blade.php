@extends('front.master')

@section('content')
    <div class="container">
        <!--Breadcrumb-->
        <nav class="my-4" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
            </ol>
        </nav><!--End Breadcrumb-->
    </div><!--End container-->
    <section class="signup text-center">
        <div class="container">
            <div class="py-4 mb-4">
                    {!! Form::open([
                        'action'    =>'Front\AuthController@registerSave',
                        'class'     => 'w-75 m-auto'
                    ]) !!}
                @include('partials.validation_errors')

                <div>
                    {!! Form::text('name' , null , [
                        'class'       => 'form-control my-3',
                        'placeholder' => 'الاسم'
                    ]) !!}
                </div>
                   <div>
                       {!! Form::text('email' , null , [
                           'class'       => 'form-control my-3',
                           'placeholder' => 'البريد الالكتروني'
                        ]) !!}
                   </div>

                <div class="input-group mb-3">
                    {!! Form::date('date_of_birth' , null , [
                         'class'       => 'form-control',
                         'placeholder' => 'تاريخ الميلاد',
                         'id'          =>  'usBirth'
                    ]) !!}
                    <i class="far fa-calendar-alt"></i>
                </div>

                <div>
                    @inject('blood_type' , 'App\Models\BloodType')
                    {!! Form::select('blood_type_id' , $blood_type->pluck('name' , 'id')->toArray() ,null , [
                         'class'       => 'form-control my-3',
                         'placeholder' => 'فصيلة الدم',
                    ]) !!}
                </div>

                    <div class="input-group mb-3">
                        @inject('governorates' , 'App\Models\Governorate')
                        {!! Form::select('governorate_id' , $governorates->pluck('name', 'id')->toArray() ,null ,[
                            'class' => 'form-control   ',
                            'id' => 'governorates',
                            'placeholder' => 'اختر محافظه',
                        ]) !!}
                    </div>

                    <div class="input-group">
                        {!! Form::select('city_id' , [] ,null ,[
                            'class' => 'form-control',
                            'id' => 'cities',
                            'placeholder' => 'اختر مدينه',
                        ]) !!}
                    </div>
                <div>
                    {!! Form::text('phone' , null , [
                        'class'       => 'form-control my-3',
                        'placeholder' => 'رقم الهاتف',

                     ]) !!}
                </div>

                <div class="input-group mb-3">
                    {!! Form::date('last_donation_date' , null , [
                         'placeholder' => 'اخر تاريخ تبرع',
                         'class'       => 'form-control',
                         'id'          =>  'datepicker'
                    ]) !!}
                    <i class="far fa-calendar-alt"></i>
                </div>

                <div>
                    {!! Form::password('password' , [
                        'class'       => 'form-control my-3',
                        'placeholder' => 'كلمة المرور'
                     ]) !!}
                </div>
                <div>
                    {!! Form::password('password_confirmation' , [
                        'class'       => 'form-control my-3',
                        'placeholder' => 'تأكيد كلمة المرور'
                     ]) !!}
                </div>

                    <button type="submit" class="btn btn-success py-2 w-50">ارسال</button>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
    @push('scripts')
        <script>

            $('#governorates').change(function (e) {
                //prvent form from submition
                e.preventDefault();

                // get governorates
                //send ajax
                //append cities
                var governorate_id = $("#governorates").val();
                if (governorate_id) {
                    $.ajax({
                        url: '{{url('api/v1/cities?governorate_id=')}}' + governorate_id,
                        type: 'get',
                        success: function (data) {
                            if (data.status == 1) {


                                $("#cities").empty();
                                $("#cities").append('<option value="">اختر مدينه</option>')
                                $.each(JSON.parse(JSON.stringify(data.data)), function (index, city) {
                                    $("#cities").append('<option value="' + city.id + '">' + city.name + '</option>');
                                });
                            }
                        },
                        error: function (jqxhr, textstatus, errorMessage) {
                            alert(errorMessage)
                        }

                    });

                } else {
                    $("#cities").empty();
                    $("#cities").append('<option value="">اختر مدينه</option>')
                }

            })

        </script>
    @endpush
@endsection



