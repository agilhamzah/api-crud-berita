<?php

namespace App\Http\Controllers;

use App\Models\PostM;
use Illuminate\Http\Request;
use App\Http\Resources\PostR;

class PostC extends Controller
{
    public function index()
    {
        $posts = PostM::latest()->paginate(5);
        return new PostR(true, 'List Data Posts', $posts);
    }
}
