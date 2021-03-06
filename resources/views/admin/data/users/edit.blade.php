@extends('admin.master')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">ویرایش کاربر</h4>

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
                        <form action="{{route('admin.users.update',['user'=>$user])}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="row">
                                @include('admin.data.users.fields',['is_edit'=>$is_edit])
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
