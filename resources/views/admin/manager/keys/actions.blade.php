<div class='btn-group btn-group-sm'>
    {{--@can('admin.keys.show')--}}
    <a data-toggle="tooltip" data-placement="bottom"
       title="مشاهده ی جزییات"
       href="{{ route('admin.keys.show',['category'=>$category]) }}"
       class='btn text-dark'>
        <i class="fa fa-eye"></i>
    </a>
    {{--@endcan--}}




    {{--@can('admin.keys.edit')--}}
    @if(!$category->trashed())
        <a data-toggle="tooltip" data-placement="bottom"
           title="ویرایش"
           href="{{ route('admin.keys.edit',['category'=>$category]) }}"
           class='btn text-info'>
            <i class="fa fa-edit"></i>
        </a>
    @endif
    {{--@endcan--}}

    @if($category->trashed())
        <span  data-toggle="tooltip" data-placement="bottom"
               title='بازیابی کلید'
               onclick="restore_row('{{ route('admin.keys.destroy',['category'=>$category]) }}','{{ Session::token() }}','آیا از بازیابی این دسته مطمئن هستین ؟ ')" class="text-success pt-1 btn">
            <i class="fa fa-redo"></i>
        </span>
    @endif

    @if(!$category->trashed())
        <span data-toggle="tooltip" data-placement="bottom"  title='حذف کلید'
              onclick="del_row('{{ route('admin.keys.destroy',['category'=>$category]) }}','{{ Session::token() }}','آیا از حذف این دسته مطمئن هستین ؟ ')" class="text-danger pt-1">
             <i class="fa fa-trash"></i>
        </span>
    @else
        <span data-toggle="tooltip"
              data-placement="bottom"
              title='حذف  کلید برای همیشه'
              onclick="del_row('{{ route('admin.keys.destroy',['category'=>$category]) }}','{{ Session::token() }}','آیا از حذف این دسته مطمئن هستین ؟ ')"
              class="text-danger pt-1 btn">
            <i class="fa fa-trash"></i>
        </span>
    @endif

    {{--@can('admin.keys.destroy')--}}
    {{--<form action="{{route('admin.keys.destroy',['category'=>$category])}}" method="post">--}}
        {{--@csrf--}}
        {{--@method('DELETE')--}}
        {{--<button type="submit" class="btn btn-link text-danger pt-1" onclick="return confirm('آیا مطمعن هستید')">--}}
            {{--<i class="fa fa-trash"></i>--}}
        {{--</button>--}}
    {{--</form>--}}
    {{--@endcan--}}

</div>
