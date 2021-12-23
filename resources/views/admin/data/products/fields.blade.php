<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column pt-4">
    <!-- Name Field -->
    <div class="form-group row ">
        <label class="col-3 control-label text-right">

            عنوان محصول
            <span class="text-danger">*</span>
        </label>
        <div class="col-9">
            <input name="title" type="text" value="{{isset($product)? $product->title : (old('title')?old('title'):'')}}" class="form-control "
                   placeholder="">
        </div>
    </div>
    <div class="form-group row ">
        <label class="col-3 control-label text-right">
            دسته ی مرتبط
            <span class="text-danger">*</span>
        </label>
        <div class="col-9">
            <select name="category_id" class="form-control "
            >
                <option value="0" selected disabled>انتخاب کنید...</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}" @if(isset($product) ? $product->category_id==$category->id :(old('category_id')?old('category_id')==$category->id : false) ) selected  @endif >
                        {{$category->title}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row ">
        <label class="col-3 control-label text-right">
            توضیحات
        </label>
        <div class="col-9">
            <textarea rows="5" name="description" type="text"  class="form-control "
                      placeholder="">{!! isset($product)?$product->description: (old('description')?old('description'):'') !!}</textarea>
        </div>
    </div>

    <div class="form-group row ">
        <label class="col-3 control-label text-right">
            قیمت به تومان
            <span class="text-danger">*</span>
        </label>
        <div class="col-9">
            <input name="price" type="text" value="{{isset($product)?$product->price: (old('price')?old('price'):'')}}" class="form-control "
                   placeholder="">
        </div>
    </div>

</div>

<div style="flex: 50%;max-width: 50%;padding: 0 20px;" class="column pt-4">
    <div class="form-group row m-1 p-2 border">
        <label class="col-12 control-label text-right">
            تصاویر محصول
        </label>
{{--        <div class="col-9 text-center">--}}
{{--            <input name="image" type="file" class="form-control ">--}}
{{--        </div>--}}

        <image-uploader images="{{isset($product)?$product->images()->select('id','url','main')->get():null}}" product_id="{{isset($product)?$product->id:0}}"></image-uploader>

{{--        @if(isset($product) && $product->images)--}}
{{--            <div class="col-12 text-center">--}}
{{--                <img src="{{getImage($product->image['url'])}}" class="m-3" style="max-width: 50%">--}}
{{--            </div>--}}
{{--        @endif--}}
    </div>


</div>
<!-- Submit Field -->
<div class="form-group col-12 text-right">
    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
        ذخیره
    </button>
    <a href="{{route('admin.products.index')}}" class="btn btn-light"><i class="fa fa-undo"></i>
        کنسل
    </a>
</div>
