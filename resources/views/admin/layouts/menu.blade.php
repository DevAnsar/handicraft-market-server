<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img
                    src="{{auth()->user()->avatar?asset(getImage(auth()->user()->avatar['url'])):asset('admin_styles/assets/images/users/avatar-2.jpg')}}"
                    alt="" class="avatar-md mx-auto rounded-circle">
            </div>

            <div class="mt-3">

                <a href="#" class="text-dark font-weight-medium font-size-16">sageh.ir</a>
                <p class="text-body mt-1 mb-0 font-size-13">
                    {{userFullName(auth()->user())}}
                </p>

            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                {{--<li class="menu-title">Menu</li>--}}

                <li>
                    <a href="{{route('admin.dashboard')}}" class=" waves-effect">
                        <i class="mdi mdi-airplay"></i>
                        {{--<span class="badge badge-pill badge-info float-right">2</span>--}}
                        <span>داشبورد</span>
                    </a>
                </li>

                <li class="menu-title">مدیریت اطلاعات</li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect has-arrow">
                        <i class="mdi mdi-comment-text-multiple-outline"></i>

                        <span>

                            سفارشات
                                        <span class="text-danger">*</span>
                        </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{--                        <li><a href="{{route('admin.orders.index')}}">لیست سفارشات</a></li>--}}

                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="waves-effect has-arrow">
                        <i class="mdi mdi-archive"></i>

                        <span>محصولات</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('admin.products.index')}}">لیست محصولات</a></li>
                            <li><a href="{{route('admin.products.create')}}">ایجاد محصول جدید</a></li>
                    </ul>
                </li>


                <li>
                    <a href="{{route('admin.users.index')}}" class=" waves-effect">
                        <i class="mdi mdi-account"></i>
                        <span>کاربران</span>
                    </a>
                </li>


                {{--                <li class="menu-title">مدیریت داده ها</li>--}}
                <li>
                    <a href="{{route('admin.categories.index')}}" class=" waves-effect">
                        <i class="mdi mdi-animation-outline"></i>
                        <span>دسته بندی</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.keys.index')}}" class=" waves-effect">
                        <i class="mdi mdi-animation-outline"></i>
                        <span>

                            کلید ها
                                    <span class="text-danger">*</span>
                        </span>
                    </a>
                </li>

            </ul>
        </div>

    </div>
</div>
