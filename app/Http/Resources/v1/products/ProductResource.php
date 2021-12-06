<?php

namespace App\Http\Resources\v1\products;

use App\Http\Resources\v1\categories\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    private $useCategory;
    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @param  bool  $useCategory
     * @return void
     */
    public function __construct($resource,$useCategory=false)
    {
        $this->useCategory=$useCategory;
        $this->resource = $resource;
    }


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data=[
            'id'=>$this->id,
            'title'=>$this->title,
            'slug'=>$this->slug,
            'price'=>$this->price,
            'price_txt'=>number_format($this->price),
            'viewCount'=>number_format($this->viewCount),
            'likeCount'=>number_format($this->likeCount),
            'image'=>'',
            'description'=>$this->description,
        ];

        if ($this->useCategory){
            $data=array_merge($data,[
                'category'=>new CategoryResource($this->category)
            ]);
        }
        return $data;
    }
}
