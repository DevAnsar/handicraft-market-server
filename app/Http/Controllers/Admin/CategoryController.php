<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;


class CategoryController extends MainController
{
    protected $model = Category::class;
    protected $title = 'دسته بندی ها';
    protected $route_params = 'categories';

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

        $categories = Category::getData($request->all(),['icon']);
        $trash_category_count = Category::onlyTrashed()->count();
        return response()->view('admin.manager.categories.index',compact('categories', 'request', 'trash_category_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return response()->view('admin.manager.categories.create');
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
            'title' => 'required|min:1',
            'label' => 'required|min:1',
        ]);

        try {
            $inputs = $request->all();
            $category = Category::create($inputs);

            if ($request->hasFile('image')) {
                $image=uploadImage($request, "categories/$category->slug/image", 'image');
                $category->image=$image['url'];
                $category->save();
            }
            return  redirect(route('admin.categories.index'));

        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        return response()->view('admin.manager.categories.edit', compact('category'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'title' => 'required|min:1',
            'label' => 'required|min:1',
        ]);

        try {
            $inputs = $request->all();
            $category->update($inputs);

            if ($request->file('image')) {
                $res = uploadImage($request->file('image'), "/categories/$category->slug/image", 'image');
                if ($res) {
                    if ($category->image) {deleteImage($category->image);}
                    $category->image=$res;
                    $category->save();
                }
            }
            return redirect(route('admin.categories.index'));
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

}
