<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\categories\CategoriesCollection;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   public  function index(){

       try{
           $categories=Category::orderBy('order_number','desc')->get();
           return JsonResponse(new CategoriesCollection($categories));
       }catch (\Exception $error){
           return JsonResponse([],false,'متاسفانه مشکلی در اجرای درجواست شما به وجود آمد. لطفا دوباره تلاش کرده و در صورت عدم رفع مشکل مراتب را به ما گزارش دهید');
       }

   }
}
