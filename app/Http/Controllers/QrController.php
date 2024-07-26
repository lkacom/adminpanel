<?php
namespace App\Http\Controllers;

use App\Models\Order;


class QrController extends Controller
{
    public function show($uuid){
        $order = Order::where('uuid',$uuid)->get()->first();
        if($order){
            return response()->json(json_decode($order->attributes));
        }
        return abort(404);
    }


}
