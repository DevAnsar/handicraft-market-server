@extends('admin.master')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">ویرایش سفارش</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                @include('admin.layouts.errors')
                <div class="card">
                    {{--@include('admin.manager.categories.navbar')--}}
                    <div class="card-body">
                        <form action="{{route('admin.orders.update',['order'=>$order])}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="row">
                                @include('admin.data.orders.fields')
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
        <!-- end row -->


    </div>
@endsection
@section('script')
    <!-- parsley plugin -->
    <script src="{{asset('assets/libs/parsleyjs/parsley.min.js')}}"></script>

    <!-- validation init -->
    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
@endsection
