<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function with($request){
       return [
           "Developer" => "Dami & Fola",
           "Repo" => url('https://www.github.com/ishoshot'),
       ];
    }
}
