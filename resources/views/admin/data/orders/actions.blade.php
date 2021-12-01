<div class='btn-group btn-group-sm'>
    {{--@can('admin.orders.show')--}}
    <a data-toggle="tooltip" data-placement="bottom"
       title="مشاهده ی جزییات"
       href="{{ route('admin.orders.show',['order'=>$order]) }}"
       class='btn text-dark'>
        <i class="fa fa-eye"></i>
    </a>
    {{--@endcan--}}




    {{--@can('admin.orders.edit')--}}
    @if(!$order->trashed())
        <a data-toggle="tooltip" data-placement="bottom"
           title="ویرایش"
           href="{{ route('admin.orders.edit',['order'=>$order]) }}"
           class='btn text-info'>
            <i class="fa fa-edit"></i>
        </a>
    @endif
    {{--@endcan--}}

    @if($order->trashed())
        <span  data-toggle="tooltip" data-placement="bottom"
               title='بازیابی سفارش'
               onclick="restore_row('{{ route('admin.orders.destroy',['order'=>$order]) }}','{{ Session::token() }}','آیا از بازیابی این سفارش مطمئن هستین ؟ ')" class="text-success pt-1 btn">
            <i class="fa fa-redo"></i>
        </span>
    @endif

    @if(!$order->trashed())
        <span data-toggle="tooltip" data-placement="bottom"  title='حذف سفارش'
              onclick="del_row('{{ route('admin.orders.destroy',['order'=>$order]) }}','{{ Session::token() }}','آیا از حذف این سفارش مطمئن هستین ؟ ')" class="text-danger pt-1">
             <i class="fa fa-trash"></i>
        </span>
    @else
        <span data-toggle="tooltip"
              data-placement="bottom"
              title='حذف  سفارش برای همیشه'
              onclick="del_row('{{ route('admin.orders.destroy',['order'=>$order]) }}','{{ Session::token() }}','آیا از حذف این سفارش مطمئن هستین ؟ ')"
              class="text-danger pt-1 btn">
            <i class="fa fa-trash"></i>
        </span>
    @endif

    {{--@can('admin.orders.destroy')--}}
    {{--<form action="{{route('admin.orders.destroy',['order'=>$order])}}" method="post">--}}
        {{--@csrf--}}
        {{--@method('DELETE')--}}
        {{--<button type="submit" class="btn btn-link text-danger pt-1" onclick="return confirm('آیا مطمعن هستید')">--}}
            {{--<i class="fa fa-trash"></i>--}}
        {{--</button>--}}
    {{--</form>--}}
    {{--@endcan--}}

</div>
