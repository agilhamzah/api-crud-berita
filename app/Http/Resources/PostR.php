<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostR extends JsonResource
{
   public $status;
   public $massage;

   public function __construct($status, $message, $resource)
   {
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
   }

   public function toArray($request)
   {
        return[
            'success' => $this->status,
            'message' => $this->message,
            'data' => $this->resource,
        ];
   }
}
