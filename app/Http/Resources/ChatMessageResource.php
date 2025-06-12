<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return[
            'message'=>$this->message,
            'name'=>$this->user->name,
            'email'=>$this->user->email,
            'timestamp'=>$this->created_at->format('d/m/Y h:i A'),
        ];
    }
}
