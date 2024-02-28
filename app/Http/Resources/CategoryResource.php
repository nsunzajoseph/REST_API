<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        //return the desired data that you want to appear into the browser
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'type'=>$this->type,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
        ];
    }
}
