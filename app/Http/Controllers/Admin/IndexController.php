<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
//use App\Models\Product;
use App\Models\Product;
use App\Models\User;

class IndexController extends Controller
{
    public function dashboard(){

        $lastUsers=User::latest()->take(3)->get();
        $usersCount=User::all()->count();
        $categoriesCount=Category::all()->count();
        $productsCount=Product::all()->count();

        return view('admin.dashboard',compact(
            'lastUsers',
            'usersCount',
            'categoriesCount',
            'productsCount'
        ));
    }
}
