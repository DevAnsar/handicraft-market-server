<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\categories\CategoriesCollection;
use App\Http\Resources\v1\products\ProductsCollection;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){


        try{
            $categories=Category::where('show_index',true)->get();
            $last_products=Product::latest()->get();
            $popular_products=Product::orderBy('viewCount','asc')->get();
            $sliders=[];

            return  JsonResponse([
                'categories'=>new CategoriesCollection($categories),
                'last_products'=>new ProductsCollection($last_products,true),
                'popular_products'=>new ProductsCollection($popular_products,true),
                'sliders'=>$sliders,
            ]);
        }catch (\Exception $error){
            return JsonResponse([],false,'متاسفانه مشکلی در اجرای درجواست شما به وجود آمد. لطفا دوباره تلاش کرده و در صورت عدم رفع مشکل مراتب را به ما گزارش دهید');

        }

    }
}
