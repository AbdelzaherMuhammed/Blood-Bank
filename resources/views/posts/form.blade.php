@inject('category' , 'App\Models\Category')
<div class="form-group">
    <label for="title">العنوان</label>
    {!! Form::text('title',null,[
        'class' =>'form-control'
    ]) !!}
    <br>
    <label for="image">الصوره</label>
    {!! Form::file('image',[
        'class' =>'form-control'

    ]) !!}
    <br>
    <label for="content">المحتوي</label>
    {!! Form::text('small_desc',null,[
        'class' =>'form-control'
    ]) !!}
    <br>

    <label for="content">المحتوي</label>
    {!! Form::textarea('content',null,[
        'class' =>'form-control',
        'rows'  => 6
    ]) !!}
    <br>
    <label for="category_id">القسم</label>
    {!! Form::select('category_id',$category->pluck('name','id')->toArray(),null,[
        'class' => 'form-control',
        'placeholder' => 'اختر المقاله',
    ]) !!}
</div>

<div class="form-group">
    <button class="btn btn-primary" type="submit">تاكيد</button>
</div>



