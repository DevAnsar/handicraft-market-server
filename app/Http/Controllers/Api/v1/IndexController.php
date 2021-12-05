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


        $categories=Category::where('show_index',true)->get();
        $last_products=Product::latest()->get();

        return response()->json([
           'status'=>true,
           'categories'=>new CategoriesCollection($categories),
           'last_products'=>new ProductsCollection($last_products),
           'description'=>'',
           'showbiz_image'=>''
        ]);
    }
}
