<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\products\ProductResource;
use App\Http\Resources\v1\products\ProductsCollection;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //get all the products or products in the selected category
    public function index(Request $request){
        try{

            $category_id=$request->query('c');
            $products=[];
            if ($category_id){
                $category=Category::find($category_id);
                if ($category){
                    $message='محصولات موجود در دسته ی انتخابی';
                    $products=$category->products;
                }else{
                    $message='دسته ای که در نظر دارید یافت نشد';
                }
            }else{
                $message='محصولات موجود در همه ی دسته ها';
                $products=Product::all();
            }
            return JsonResponse(new ProductsCollection($products,true),true,$message);

        }catch (\Exception $exception){

            return JsonResponse([],false,'متاسفانه مشکلی در اجرای درجواست شما به وجود آمد. لطفا دوباره تلاش کرده و در صورت عدم رفع مشکل مراتب را به ما گزارش دهید');
        }
    }

    //get the product details
    public function get_product(Request $request){
        try{

            $product=null;
            $product_id=$request->product_id;
            if ($product_id){
                $product=Product::find($product_id);
                if ($product){
                    $message='محصول در دستان شماست';
                }else{
                    $message='محصول با آیدی مورد نظر یافت نشد';
                }
            }else{
                $message='آیدی محصول ارسال نشده است';
            }
            return JsonResponse([
                'product'=>new ProductResource($product,true)
            ],true,$message);

        }catch (\Exception $exception){

            return JsonResponse([],false,'متاسفانه مشکلی در اجرای درجواست شما به وجود آمد. لطفا دوباره تلاش کرده و در صورت عدم رفع مشکل مراتب را به ما گزارش دهید');
        }
    }


}
