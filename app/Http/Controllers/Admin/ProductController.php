<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Search\ProductSearch;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;


class ProductController extends MainController
{
    protected $model = Product::class;
    protected $title = 'محصولات';
    protected $route_params = 'products';

    public function route_params($data){
        return $this->route_params;
    }
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $products_query =new ProductSearch(0,10);
        $products=$products_query->getSearch($request);
        $trash_product_count = Product::onlyTrashed()->count();
        return response()->view('admin.data.products.index',compact('products', 'request', 'trash_product_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories=Category::all();
        return response()->view('admin.data.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return array
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:4',
            'price' => 'required',
            'category_id' => 'required',
        ]);

        try {
            $inputs = $request->all();
            $product = Product::create($inputs);

//            if ($request->hasFile('image')) {
//                $image=uploadImage($request, "categories/$category->slug/image", 'image');
//                $category->image=$image['url'];
//                $category->save();
//            }
            return  redirect(route('admin.products.index'));

        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        $categories=Category::all();
        return response()->view('admin.data.products.edit', compact('product','categories'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'title' => 'required|min:4',
            'price' => 'required',
            'category_id' => 'required',
        ]);

        try {
            $inputs = $request->all();
            $product->update($inputs);

//            if ($request->file('image')) {
//                $res = uploadImage($request->file('image'), "/categories/$category->slug/image", 'image');
//                if ($res) {
//                    if ($category->image) {deleteImage($category->image);}
//                    $category->image=$res['url'];
//                    $category->save();
//                }
//            }
            return redirect(route('admin.products.index'));
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

}
