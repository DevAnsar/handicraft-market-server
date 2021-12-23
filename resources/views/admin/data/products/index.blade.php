@extends('admin.master')
@section('content')


    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">لیست محصولات</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                <div class="card">

                    <div class="panel_content">
                        @include('admin.layouts.navbar',[
                        'count'=>$trash_product_count,
                        'route'=>'admin/products',
                        'title'=>'محصول/خدمت'])

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
                                        <th>نام محصول</th>
                                        <th>تصویر</th>
                                        <th>دسته</th>
                                        <th>قیمت</th>
                                        <th>تنظیمات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $key=>$product)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="products_id[]" class="check_box"
                                                       value="{{ $product->id }}"/>
                                            </td>
                                            <th>{{$product->title}}</th>
                                            <th>

{{--                                                @include('admin.layouts.img',['url'=>$product->images ? ($product->images()->where('main',true)->first()? $product->images()->where('main',true)->first()['url']:null ):null])--}}
                                            </th>

                                            <th>{{$product->category? $product->category->title: '-'}}</th>

                                            <th>{{number_format($product->price)}}
                                                تومان
                                            </th>
                                            <th>
                                                @include('admin.data.products.actions',['product'=>$product])
                                            </th>
                                        </tr>
                                    @endforeach

                                    @if(sizeof($products)==0)
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
                            @include('admin.layouts.paginate',['paginator'=>$products])
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
