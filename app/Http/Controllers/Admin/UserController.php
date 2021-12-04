<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Search\UserSearch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends MainController
{
    protected $model = User::class;
    protected $title = 'کاربر';
    protected $route_params = 'users';
    public function route_params($data){
//        foreach ($data as $d){
//            $this->route_params=$this->route_params . 'questions/'.$d.'/answers';
//        }
        return $this->route_params;
    }
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $users_search=new UserSearch(0,6);
        $users=$users_search->getSearch($request);
        $trash_user_count = User::onlyTrashed()->count();
        $allCategories=Category::oldest()->select(['id','title','slug','image'])->get();
        return response()->view('admin.data.users.index', compact('users', 'request', 'trash_user_count','allCategories'));
    }

    public function store_category($user_id,Request $request){
//        return $request->data;

        try{
            $category_id=$request->data;
            $user=User::find($user_id);
            if ($user){
                $user->category=$category_id;
                $user->save();
            }
            return response()->json([
                'status'=>true,
                'message'=>'دسته با موفق برای کاربر ثبت شد'
            ]);
        }catch (\Exception $exception){
            return response()->json([
                'status'=>false,
                'message'=>$exception->getMessage()
            ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('admin.data.users.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return User
     */
    public function show(User $user)
    {

        return $user;
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
            'name' => 'required|min:1',
            'family' => 'nullable',
            'username' => 'nullable',
            'national_code' => 'nullable',
            'mobile' => 'required',
            'email' => 'nullable',
            'password' => 'required',
        ]);

        try {

            ////////////// initial user data
            $password=$request->input('password');
             if ($password==null || $password==''){$password='biilche';}
            $username=$request->input('username');
             if (!$username){
                $username='u_'.generateRandomNumber(4);
             }
            ///////////////

            $inputs = $request->all();
            $user = User::create(array_merge($inputs,[
                'password'=>Hash::make($password),
                'username'=>$username
            ]));

            if ($request->hasFile('avatar')) {
                $avatar=uploadImage($request, "users/$user->id/avatar", 'avatar');
                $user->avatar()->create(['url' =>$avatar['url'], 'type' => 'avatar']);
            }
            if ($request->hasFile('national_cart_image')) {
                $image=uploadImage($request, "users/$user->id/national_cart", 'national_cart_image');
                $user->national_cart_image()->create(['url' => $image['url'], 'type' => 'national_cart_image']);
            }
            return redirect(route('admin.users.index'));

        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $is_edit=true;
        return response()->view('admin.data.users.edit', compact('user','is_edit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return array
     * @throws ValidationException
     */
    public function update(Request $request,User $user)
    {
        $this->validate($request, [
            'name' => 'required|min:1',
            'family' => 'nullable',
            'username' => 'nullable',
            'national_code' => 'nullable',
            'mobile' => 'required'
        ]);

        try {

            $data=[];
            ////////////// initial user data
            $password=$request->input('password');
            if ($password!=null || $password!=''){
                $data=array_merge($data,['password'=>Hash::make($password)]);
            }else{
                unset($request['password']);
            }
            ///////////////

            $inputs = $request->all();
            $user->update(array_merge($inputs,$data));

            if ($request->file('avatar')) {
                $res = uploadImage($request, "users/$user->id/avatar", 'avatar');
                if ($res['status']) {
                    if ($user->avatar) {
                        deleteImage($user->avatar);
                        $user->avatar=$res['url'];
                        return $user->avatar;
                    } else {
                        $user->avatar=$res['url'];
                    }
                    $user->save();
                }
            }

            if ($request->file('national_cart_image')) {
                $res = uploadImage($request, "/users/$user->id/national_cart", 'national_cart_image');
                if ($res['status']) {
                    if ($user->national_cart_image) {
                        deleteImage($user->national_cart_image['url']);
                        $user->national_cart_image=$res['url'];
                    } else {
                        $user->national_cart_image=$res['url'];
                    }
                    $user->save();
                }
            }
            return redirect(route('admin.users.index'));

        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }

    }
}
