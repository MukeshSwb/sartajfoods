@foreach($orders as $key=>$order)

    <tr class="status-{{$order['order_status']}} class-all">
        <td class="">
            {{$key+1}}
        </td>
        <td class="table-column-pl-0">
            <a href="{{route('branch.orders.details',['id'=>$order['id']])}}">{{$order['id']}}</a>
        </td>
        <td>{{date('d M Y',strtotime($order['created_at']))}}</td>
        <td>
            @if($order->customer)
                <a class="text-body text-capitalize"
                   href="{{route('branch.orders.details',['id'=>$order['id']])}}">{{$order->customer['f_name'].' '.$order->customer['l_name']}}</a>
            @else
                <label
                    class="badge badge-danger">{{translate('invalid')}} {{translate('customer')}} {{translate('data')}}</label>
            @endif
        </td>
        <td>
            @if($order->payment_status=='paid')
                <span class="badge badge-soft-success">
                                      <span class="legend-indicator bg-success"></span>{{translate('paid')}}
                                    </span>
            @else
                <span class="badge badge-soft-danger">
                                      <span class="legend-indicator bg-danger"></span>{{translate('unpaid')}}
                                    </span>
            @endif
        </td>
        <td>
            <div class="d-flex align-items-center">
                <span class="text-dark">{{$order['payment_method']}}</span>
            </div>
        </td>
        <td>{{ Helpers::set_symbol($order['order_amount']) }}</td>
        <td class="text-capitalize">
            @if($order['order_status']=='pending')
                <span class="badge badge-soft-info ml-2 ml-sm-3">
                                        <span class="legend-indicator bg-info"></span>{{translate('pending')}}
                                    </span>
            @elseif($order['order_status']=='confirmed')
                <span class="badge badge-soft-info ml-2 ml-sm-3">
                                      <span class="legend-indicator bg-info"></span>{{translate('confirmed')}}
                                    </span>
            @elseif($order['order_status']=='processing')
                <span class="badge badge-soft-warning ml-2 ml-sm-3">
                                      <span class="legend-indicator bg-warning"></span>{{translate('packaging')}}
                                    </span>
            @elseif($order['order_status']=='out_for_delivery')
                <span class="badge badge-soft-warning ml-2 ml-sm-3">
                                      <span class="legend-indicator bg-warning"></span>{{translate('out_for_delivery')}}
                                    </span>
            @elseif($order['order_status']=='delivered')
                <span class="badge badge-soft-success ml-2 ml-sm-3">
                                      <span class="legend-indicator bg-success"></span>
                                      {{-- {{translate('delivered')}}--}} 
                                            {{translate('completed')}}

                                    </span>
            @else
                <span class="badge badge-soft-danger ml-2 ml-sm-3">
                                      <span class="legend-indicator bg-danger"></span>{{str_replace('_',' ',$order['order_status'])}}
                                    </span>
            @endif
        </td>
        <td>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    <i class="tio-settings"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item"
                       href="{{route('branch.orders.details',['id'=>$order['id']])}}"><i
                            class="tio-visible"></i> {{translate('view')}}</a>
                    <a class="dropdown-item" target="_blank"
                       href="{{route('branch.orders.generate-invoice',[$order['id']])}}"><i
                            class="tio-download"></i> {{translate('invoice')}}</a>
                </div>
            </div>
        </td>
    </tr>

@endforeach
