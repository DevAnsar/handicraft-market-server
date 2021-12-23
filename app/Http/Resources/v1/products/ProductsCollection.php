<?php

namespace App\Http\Resources\v1\products;

use App\Http\Resources\v1\categories\CategoryResource;
use App\Http\Resources\v1\images\ImageResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsCollection extends ResourceCollection
{
    private $useCategory=[];

    /**
     * Create a new resource instance.
     *
     * @param $resource
     * @param bool $useCategory
     */
    public function __construct($resource,$useCategory=false)
    {
        $this->useCategory=$useCategory;
        parent::__construct($resource);

    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable
     */
    public function toArray($request)
    {

        return $this->collection->map(function ($product){
            $data=[
                'id'=>$product->id,
                'title'=>$product->title,
                'slug'=>$product->slug,
                'price'=>$product->price,
                'price_txt'=>number_format($product->price),
                'viewCount'=>number_format($product->viewCount),
                'likeCount'=>number_format($product->likeCount),
                'image'=>new ImageResource($product->images()->where('main','=',true)->first()),
                'description'=>$product->description,
            ];

            if ($this->useCategory){
                $data=array_merge($data,[
                    'category'=>new CategoryResource($product->category)
                ]);
            }
            return $data;
        });
    }
}
