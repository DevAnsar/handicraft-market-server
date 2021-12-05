<?php

namespace App\Http\Resources\v1\categories;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoriesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($category){
            return [
                'title'=>$category->title,
                'slug'=>$category->slug,
                'image'=>$category->image
            ];
        });
    }
}
