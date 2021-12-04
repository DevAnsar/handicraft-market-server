<?php

namespace App\Models\Search;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class UserSearch
{
    use HasFactory;

    public $category_id;
    public $string = '?';
    protected $paginate;

    public function __construct($category_id=0, $paginate = 10)
    {
        $this->category_id = $category_id;
        $this->paginate = $paginate;
    }

    public function getSearch(Request $request, $with = [])
    {

         $users = User::query()->orderBy('created_at','DESC');

        if(inTrashed($request))
        {

            $users=$users->onlyTrashed();
            $this->string=create_paginate_url($this->string,'trashed=true');
        }
        if(isset($request['string']) && !empty($request['string']))
        {
            $searchValues = preg_split('/\s+/', $request['string']);
            $users->where(function ($query) use ($searchValues) {
                foreach ($searchValues as $value) {
                    $query->where('name', 'like', '%' . $value . '%')
                        ->orWhere('family', 'like', '%' . $value . '%')
                        ->orWhere('username', 'like', '%' . $value . '%');
                }
            });
            $this->string=create_paginate_url($this->string,'string='.$request['string']);
        }

        foreach ($with as $item) {
            if ($item != '') {
                $users->with($item);
            }
        }

        if ($this->category_id != 0) {
            $users->whereHas('categories', function ($q) {
                $q->where('id', $this->category_id);
            });
        }

        $users=$users->paginate($this->paginate);
        $users=$users->withPath($this->string);
        $this->users = $users;

        return $users;
    }
}
