<?php

namespace App\Models\Search;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class ProductSearch
{
    use HasFactory;

    public $category_id=0;
    public $products = [];
    public $string = '?';
    protected $paginate;

    public function __construct($category_id=0, $paginate = 10)
    {
        $this->category_id = $category_id;
        $this->paginate = $paginate;
    }

    public function getSearch(Request $request, $with = [])
    {
        if ($this->category_id != 0){
            $category=Category::find($this->category_id);
            $products=$category ? $category->products()->orderBy('created_at','DESC'):Product::query()->orderBy('created_at','DESC');
        }else{
            $products = Product::query()->orderBy('created_at','DESC');

        }

        if(inTrashed($request))
        {

            $products=$products->onlyTrashed();
            $this->string=create_paginate_url($this->string,'trashed=true');
        }
        if(isset($request['string']) && !empty($request['string']))
        {
            $searchValues = preg_split('/\s+/', $request['string']);
            $products->where(function ($q) use ($searchValues) {
                foreach ($searchValues as $value) {
                    $q->where('title', 'like', '%' . $value . '%')
                        ->orWhere('slug', 'like', '%' . $value . '%')
                        ->orWhere('description', 'like', '%' . $value . '%');
                }
            });
            $this->string=create_paginate_url($this->string,'string='.$request['string']);
        }

        foreach ($with as $item) {
            if ($item != '') {
                $products->with($item);
            }
        }
        $products=$products->paginate($this->paginate);
        $products=$products->withPath($this->string);
        $this->products = $products;

        return $products;
    }

    public function getSearchForClient(Request $request, $with = [])
    {

        if (!empty($this->category)) {

                return $products=$this->category->products()->get();

        }
        else{
            $products = Product::query();
        }

        if ($request->has('order_by') && $request->input('order_by')!=''){
            $order_by=$request->input('order_by');

            switch ($order_by){
                case 'ASC':
                    $products=$products->orderBy('created_at','ASC');
                case 'DESC':
                    $products=$products->orderBy('created_at','DESC');

                default:
                    $products=$products->orderBy('created_at','DESC');
                    break;
            }
        }else{
            $products=$products->orderBy('created_at','DESC');
        }

        if ($request->has('city_id') && is_numeric($request->input('city_id')) && $request->input('city_id')!=0){
            $products=$products->where('city_id','=',$request->input('city_id'));
        }
        if ($request->has('user_id') && is_numeric($request->input('user_id')) && $request->input('user_id')!=0){
            $products=$products->where('user_id','=',$request->input('user_id'));
        }

        if(isset($request['string']) && !empty($request['string']))
        {
            $searchValues = preg_split('/\s+/', $request['string']);
            $products->where(function ($q) use ($searchValues) {
                foreach ($searchValues as $value) {
                    $q->where('content', 'like', '%' . $value . '%');
                }
            });
        }


        foreach ($with as $item) {
            if ($item != '') {
                $products->with($item);
            }
        }



        $products=$products->paginate($this->paginate);
//        $products=$products->withPath($this->string);
        $this->products = $products;

        return $products;
    }
}
