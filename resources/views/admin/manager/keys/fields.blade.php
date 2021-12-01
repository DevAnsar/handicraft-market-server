<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column pt-4">
    <!-- Name Field -->
    <div class="form-group row ">
        <label class="col-3 control-label text-right">
            عنوان کلید
        </label>
        <div class="col-9">
            <input name="title" type="text" value="{{isset($key)?$key->title:''}}" class="form-control "
                   placeholder="">
        </div>
    </div>

    <div class="form-group row ">
        <label class="col-3 control-label text-right">
            عنوان به انگلیسی
        </label>
        <div class="col-9">
            <input name="label" type="text" value="{{isset($key)?$key->label:''}}" class="form-control "
                   placeholder="">
        </div>
    </div>

</div>

<div style="flex: 50%;max-width: 50%;padding: 0 20px;" class="column pt-4">
    <div class="form-group row m-1 p-2 border">
        <label class="col-3 control-label text-right">
            آیکن
        </label>
        <div class="col-9 text-center">
            <input name="icon" type="file" class="form-control " >
        </div>

        @if(isset($key) && $key->icon)
            <div class="col-12 text-center">
                <img src="{{getImage($key->icon['url'])}}" class="m-3" style="max-width: 50%" >
            </div>
        @endif
    </div>

    <div class="form-group row m-1 p-2 border">
        <label class="col-3 control-label text-right">
            تصویر
        </label>
        <div class="col-9">
            <input name="image" type="file" class="form-control ">
        </div>

        @if(isset($key) && $key->image)
            <div class="col-12 text-center">
                <img src="{{getImage($key->image['url'])}}" class="m-3" style="max-width: 50%" >
            </div>
        @endif
    </div>


</div>
<!-- Submit Field -->
<div class="form-group col-12 text-right">
    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
        ذخیره
    </button>
    <a href="{!! URL::previous() !!}" class="btn btn-light"><i class="fa fa-undo"></i>
        کنسل
    </a>
</div>
