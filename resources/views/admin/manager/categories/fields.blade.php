<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column pt-4">
    <!-- Name Field -->
    <div class="form-group row ">
        <label class="col-3 control-label text-right">
            عنوان دسته بندی
            <span class="text-danger">*</span>
        </label>
        <div class="col-9">
            <input name="title" type="text" value="{{isset($category)?$category->title:''}}" class="form-control "
                   placeholder="">
        </div>
    </div>

    <div class="form-group row ">
        <label class="col-3 control-label text-right">
            عنوان به انگلیسی
            <span class="text-danger">*</span>
        </label>
        <div class="col-9">
            <input name="label" type="text" value="{{isset($category)?$category->label:''}}" class="form-control "
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
            <input name="image" type="file" class="form-control " >
        </div>

        @if(isset($category) && $category->image)
            <div class="col-12 text-center">
                <img src="{{getImage($category->image)}}" class="m-3" style="max-width: 50%" >
            </div>
        @endif
    </div>


</div>
<!-- Submit Field -->
<div class="form-group col-12 text-right">
    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
        ذخیره
    </button>
    <a href="{{route('admin.categories.index')}}" class="btn btn-light"><i class="fa fa-undo"></i>
        کنسل
    </a>
</div>
