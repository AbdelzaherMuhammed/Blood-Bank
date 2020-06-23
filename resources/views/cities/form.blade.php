@inject('governorate','App\Models\Governorate')
<div class="form-group">
    <label for="name">الاسم</label>
    {!! Form::text('name',null,[
        'class' =>'form-control'
    ]) !!}

    <br>

    <label for="governorate_id">المحافظه</label>
    {!! Form::select('governorate_id',$governorate->pluck('name','id')->toArray(),null,[
        'class' => 'form-control',
        'placeholder' => 'اختر المحافظه',
    ]) !!}

</div>

<div class="form-group">
    <button class="btn btn-primary" type="submit">Submit</button>
</div>



