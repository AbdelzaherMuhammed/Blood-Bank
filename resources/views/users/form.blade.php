@inject('role' ,'App\Models\Role')

<?php
$roles = $role->pluck('display_name' , 'id')->toArray();
?>



<div class="form-group">
    <label for="name">الاسم</label>
    {!! Form::text('name',null,[
        'class' =>'form-control'
    ]) !!}
</div>

<div class="form-group">
    <label for="email">البريد الالكتروني</label>
    {!! Form::text('email',null,[
        'class' =>'form-control'
    ]) !!}
</div>

<div class="form-group">
    <label for="password">كلمة المرور</label>
    {!! Form::password('password',[
        'class' =>'form-control',
    ]) !!}
</div>

<div class="form-group">
    <label for="password_confirmation">كلمة المرور</label>
    {!! Form::password('password_confirmation',[
        'class' =>'form-control',
    ]) !!}
</div>
<div class="form-group" dir="rtl">
    <label for="roles_list">رتب المستخدمين</label>
    {!! Form::select('roles_list[]', $roles ,null,[
        'id' => 'role',
        'class' =>'form-control select2',
        'multiple' => 'multiple',

    ]) !!}
</div>

<div class="form-group">
    <button class="btn btn-primary" type="submit">تاكيد</button>
</div>


@push('select2')
    <script type="text/javascript" >
        $('#role').select2({
            placeholder: 'اختر رتبه'
        });
    </script>
@endpush
