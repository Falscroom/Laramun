<?php


namespace App\Http\Controllers;

use App\Http\Services\PostService;
use Auth;
use App\MunrfePost;
use App\MunrfePost as Post;

class NewsController
{
    /** @var PostService */
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        /** @var MunrfePost $post */
        $news = Post::orderBy('id', 'desc')->paginate(10);
        $this->postService->populateWithUsers($news);
        return view('news', [
            'news' => $news
        ]);
    }
}
