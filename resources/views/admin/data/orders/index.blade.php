@extends('admin.master')
@section('content')


    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">لیست سفارشات و خدمات</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                <div class="card">

                    <div class="panel_content">
                        @include('admin.layouts.navbar',[
                        'count'=>$trash_order_count,
                        'route'=>'admin/orders',
                        'title'=>'سفارش/خدمت'])

                        <div class="card-body">


                            {{--<form method="get" class="search_form">--}}
                            {{--@if(isset($_GET['trashed']) && $_GET['trashed']==true)--}}
                            {{--<input type="hidden" name="trashed" value="true">--}}
                            {{--@endif--}}
                            {{--<input type="text" name="search" class="form-control" value="{{ $request->get('search','') }}" placeholder="">--}}
                            {{--<button class="btn btn-primary" style="margin-right:80px">جست و جو</button>--}}
                            {{--</form>--}}


                            <form method="post" id="data_form">
                                @csrf
                                <table class="table table-hover mb-0">

                                    <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>#</th>
                                        <th>تصویر</th>
                                        <th>نام سفارش</th>
                                        <th>فروشنده</th>
                                        <th>دسته / صنف</th>
                                        {{--<th>مهارت های شغلی مرتبط با دسته</th>--}}
                                        <th>قیمت</th>
                                        <th>تنظیمات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $key=>$order)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="orders_id[]" class="check_box"
                                                       value="{{ $order->id }}"/>
                                            </td>
                                            <th>{{$key+1}}</th>
                                            <th>
                                                @include('admin.layouts.img',['url'=>$order->image ? $order->image['url']:null])
                                            </th>
                                            <th>{{$order->title}}</th>
                                            <th>
                                                @if($order->user)
                                                    <a href="{{route('admin.users.show',['user'=>$order->user])}}"
                                                       style="font-size: 0.6rem"
                                                       class="badge badge-pill badge-soft-success py-1 px-2 m-1">
                                                        {{userFullName($order->user)}}
                                                    </a>
                                                @else
                                                    <span
                                                       style="font-size: 0.6rem"
                                                       class="badge badge-pill badge-soft-danger py-1 px-2 m-1">
                                                        حذف شده
                                                        (
                                                        userId:
                                                        {{$order->user_id}}
                                                        )
                                                    </span>
                                                @endif
                                            </th>
                                            <th>{{$order->category? $order->category->title: '-'}}</th>
                                            {{--<th>--}}
                                            {{--<button class="btn btn-sm ">--}}
                                            {{--<one-to-many--}}
                                            {{--title=" مهارت های شغلی سفارش {{$order->name}}  "--}}
                                            {{--:one="{{json_encode($order)}}"--}}
                                            {{--:one_many="{{json_encode($order->skills)}}"--}}
                                            {{--:many="{{json_encode($order->category->skills)}}"--}}
                                            {{--:submit_url="{{json_encode(route('admin.orders.skills.sync',['order_id'=>$order->id]))}}"--}}
                                            {{--submit_title="ثبت مهارت ها ی شغلی برای سفارش"--}}
                                            {{--></one-to-many>--}}
                                            {{--</button>--}}
                                            {{--</th>--}}
                                            <th>{{number_format($order->price)}}
                                                تومان
                                            </th>
                                            <th>
                                                @include('admin.data.orders.actions',['order'=>$order])
                                            </th>
                                        </tr>
                                    @endforeach

                                    @if(sizeof($orders)==0)
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                <span class="badge badge-pill badge-light p-3">
                                                رکوردی برای نمایش وجود ندارد
                                                    </span>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </form>

                        </div>
                        <div class="card-footer">
                            @include('admin.layouts.paginate',['paginator'=>$orders])
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- end row -->

        {{--<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>--}}
        {{--<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>--}}

    </div>
@endsection
