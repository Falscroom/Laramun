<?php

namespace App\Http\Controllers;

use App\MunrfePost;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\MunrfePost as Post;

class MainController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
        /** @var MunrfePost[] $posts */
        $posts = Post::latest()->take(6)->get();

        return view('main',[
            'posts' => $posts
        ]);
    }
}
