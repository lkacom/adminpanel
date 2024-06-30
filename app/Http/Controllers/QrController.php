<?php
namespace App\Http\Controllers;

use App\Models\UserServicesEloquent;


class QrController extends Controller
{
    public $user;

    public function show($uuid){
        $service = UserServicesEloquent::where('uuid',$uuid)->get()->first();
        if($service){
            return response()->json(json_decode($service->config));
        }
        return abort(404);
    }


}
