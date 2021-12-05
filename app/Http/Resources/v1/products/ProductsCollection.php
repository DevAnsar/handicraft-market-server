<?php

namespace App\Http\Resources\v1\products;

use App\Http\Resources\v1\categories\CategoryResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($product){
            return[
                'id'=>$product->id,
                'title'=>$product->title,
                'slug'=>$product->slug,
                'price'=>$product->price,
                'price_txt'=>number_format($product->price),
                'viewCount'=>number_format($product->viewCount),
                'likeCount'=>number_format($product->likeCount),
                'image'=>'',
                'description'=>$product->description,
                'category'=>new CategoryResource($product->category)
            ];
        });
    }
}
