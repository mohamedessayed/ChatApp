<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageEvent;
use App\Http\Resources\ChatMessageResource;
use App\Models\ChatMessage;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatMessageController extends Controller
{
    //

    use ResponseTrait;


    function all() : object {
        return $this->sendSuccess(ChatMessageResource::collection(ChatMessage::all()));
    }

    function send(Request $request) : object {
        $validation = Validator::make($request->all(),[
            'message'=>'required|string',
        ]);


        if ($validation->fails()) {
            # code...
            return $this->sendError($validation->errors());
        }

        try {
            //code...

            $user_id = Auth::guard('api')->id();

            $message = ChatMessage::create([
                'message'=>$request->message,
                'user_id'=>$user_id
            ]);

            event(new ChatMessageEvent($message));

            return $this->sendSuccess([]);

        } catch (\Throwable $th) {
            //throw $th;
            return $this->sendError(['message'=>$th->getMessage()]);
        }
    }
}
