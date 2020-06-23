@inject('perm' , 'App\Models\Permission')

<div class="form-group">
    <label for="name">الاسم</label>
    {!! Form::text('name',null,[
        'class' =>'form-control'
    ]) !!}
</div>

<div class="form-group">
    <label for="display_name">الاسم المعروض</label>
    {!! Form::text('display_name',null,[
        'class' =>'form-control'
    ]) !!}
</div>

<div class="form-group">
    <label for="description">الوصف</label>
    {!! Form::textarea('description',null,[
        'class' =>'form-control',
        'rows' => 4
    ]) !!}
</div>

<div class="form-group">
    <label for="permissons_list">الصلاحيات</label>
    <br>
    <input id="select-all" type="checkbox"><label for='select-all'>اختيار الكل</label>
    <div class="row">
        @foreach($perm->all() as $permission)
            <div class="col-sm-3">
                <div class="custom-checkbox">
                    <label>
                        <input type="checkbox" name="permissions_list[]" value="{{$permission->id}}"

                            @if($model->hasPermission($permission->name))
                               checked
                            @endif

                        >{{$permission->display_name}}

                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="form-group">
    <button class="btn btn-primary" type="submit">تأكيد</button>
</div>

@push('scripts')
    <script>
        $("#select-all").click(function () {
            $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
        });
    </script>
@endpush

