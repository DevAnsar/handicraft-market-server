<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column pt-4">
    <!-- Name Field -->
    <div class="form-group row ">
        <label class="col-3 control-label text-right">
            نام
            <span class="text-danger">*</span>
        </label>
        <div class="col-9">
            <input name="name" type="text" value="{{isset($user)?$user->name:''}}" class="form-control "
                   placeholder="">
        </div>
    </div>

    <div class="form-group row ">
        <label class="col-3 control-label text-right">
            نام خانوادگی
        </label>
        <div class="col-9">
            <input name="family" type="text" value="{{isset($user)?$user->family:''}}" class="form-control "
                   placeholder="">
        </div>
    </div>

    <div class="form-group row ">
        <label class="col-3 control-label text-right">
            نام کاربری
        </label>
        <div class="col-9">
            <input name="username" type="text" value="{{isset($user)?$user->username:''}}" class="form-control "
                   placeholder="">
        </div>
    </div>

    <div class="form-group row ">
        <label class="col-3 control-label text-right">
            کد ملی
        </label>
        <div class="col-9">
            <input name="national_code" type="text" value="{{isset($user)?$user->national_code:''}}"
                   class="form-control "
                   placeholder="">
        </div>
    </div>

    <div class="form-group row ">
        <label class="col-3 control-label text-right">
            ایمیل
        </label>
        <div class="col-9">
            <input name="email" type="email" value="{{isset($user)?$user->email:''}}" class="form-control "
                   placeholder="">
        </div>
    </div>

    <div class="form-group row ">
        <label class="col-3 control-label text-right">
            موبایل
            <span class="text-danger">*</span>
        </label>
        <div class="col-9">
            <input name="mobile" type="text" value="{{isset($user)?$user->mobile:''}}" class="form-control "
                   placeholder="">
        </div>
    </div>

    @if(!$is_edit)
    <div class="form-group row ">
        <label class="col-3 control-label text-right">
            رمز عبور
            <span class="text-danger">*</span>
        </label>
        <div class="col-9">
            <input name="password" type="text"  class="form-control "
                   placeholder="">
        </div>
    </div>
        @endif

</div>

<div style="flex: 50%;max-width: 50%;padding: 0 20px;" class="column pt-4">
    <div class="form-group row m-1 p-2 border">
        <label class="col-3 control-label text-right">
            آواتار
        </label>
        <div class="col-9 text-center">
            <input name="avatar" type="file" class="form-control ">
        </div>

        @if(isset($user) && $user->avatar)
            <div class="col-12 text-center">
                <img src="{{getImage($user->avatar)}}" class="m-3" style="max-width: 50%">
            </div>
        @endif
    </div>

    <div class="form-group row m-1 p-2 border">
        <label class="col-3 control-label text-right">
            تصویر کارت ملی
        </label>
        <div class="col-9">
            <input name="national_cart_image" type="file" class="form-control ">
        </div>
        @if(isset($user) && $user->national_cart_image)
            <div class="col-12 text-center">
                @if(getImage($user->national_cart_image))
                    <img src="{{getImage($user->national_cart_image)}}" class="m-3" style="max-width: 50%">
                @endif
            </div>
        @endif
    </div>


</div>
<!-- Submit Field -->
<div class="form-group col-12 text-right">
    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
        ذخیره
    </button>
    <a href="{{route('admin.users.index')}}" class="btn btn-light"><i class="fa fa-undo"></i>
        کنسل
    </a>
</div>
