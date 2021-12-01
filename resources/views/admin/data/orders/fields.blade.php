<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column pt-4">
    <!-- Name Field -->
    <div class="form-group row ">
        <label class="col-3 control-label text-right">
            عنوان سفارش
        </label>
        <div class="col-9">
            <input name="title" type="text" value="{{isset($order)?$order->title:''}}" class="form-control "
                   placeholder="">
        </div>
    </div>
    <div class="form-group row ">
        <label class="col-3 control-label text-right">
            برای کاربر
        </label>
        <div class="col-9">
            <select name="user_id" class="form-control "
            >
                <option value="0" selected disabled>انتخاب کنید...</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}" @if(isset($order) && $order->user_id==$user->id) selected  @endif >
                        {{$user->name}}
                        {{$user->family}}
                        -
                        {{$user->mobile}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row ">
        <label class="col-3 control-label text-right">
            دسته ی مرتبط
        </label>
        <div class="col-9">
            <select name="category_id" class="form-control "
            >
                <option value="0" selected disabled>انتخاب کنید...</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}" @if(isset($order) && $order->category_id==$category->id) selected  @endif >
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
                      placeholder="">{!! isset($order)?$order->description:'' !!}</textarea>
        </div>
    </div>

    <div class="form-group row ">
        <label class="col-3 control-label text-right">
            قیمت
        </label>
        <div class="col-9">
            <input name="price" type="text" value="{{isset($order)?$order->price:''}}" class="form-control "
                   placeholder="">
        </div>
    </div>
    <div class="form-group row ">
        <label class="col-3 control-label text-right">
            واحد قیمت
        </label>
        <div class="col-9">
            <input name="price_type" type="text" value="{{isset($order)?$order->price_type:''}}" class="form-control "
                   placeholder="">
        </div>
    </div>


</div>

<div style="flex: 50%;max-width: 50%;padding: 0 20px;" class="column pt-4">
    <div class="form-group row m-1 p-2 border">
        <label class="col-3 control-label text-right">
            تصویر شاخص سفارش
        </label>
        <div class="col-9 text-center">
            <input name="image" type="file" class="form-control ">
        </div>

        @if(isset($order) && $order->image)
            <div class="col-12 text-center">
                <img src="{{getImage($order->image['url'])}}" class="m-3" style="max-width: 50%">
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
