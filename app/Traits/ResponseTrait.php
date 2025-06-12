<?php


namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\MessageBag;

trait ResponseTrait{

    function sendError(array|MessageBag $data, string $message = 'error in process your request'):object {
        return response()->json(['status'=>'fali','message'=>$message,'data'=>$data]);
    }

    function sendSuccess(array|Collection|AnonymousResourceCollection|JsonResource $data, string $message = 'suucess in process your request'):object {
        return response()->json(['status'=>'success','message'=>$message,'data'=>$data]);
    }
}