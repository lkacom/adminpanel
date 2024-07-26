<div>
    <div>
        <div>
            <h3>{{__('my_services.details')}}</h3>
        </div>
    </div>
    
    <div>
        <div>
            <div style="font-weight: bold; width: 150px; float: left">{{__('my_orders.name')}}</div>
            <div style="display: table">{{$order->product->name}}</div>
        </div>

        <div>
            <div style="font-weight: bold; width: 150px; float: left">{{__('my_orders.activation_date')}}</div>
            <div style="display: table">{{$order->created_at}}</div>
        </div>

        <div>
            <div style="font-weight: bold; width: 150px; float: left">{{__('my_orders.expiration_date')}}</div>
            <div style="display: table">{{$order->expiration_date}}</div>
        </div>

        <div>
            <div style="font-weight: bold; width: 150px; float: left">{{__('my_orders.fragment_config')}}</div>
            <div style="display: table" rel="nofollow">{{$order->attributes}}</div>
        </div>
    </div>
</div>
