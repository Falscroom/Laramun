<?php


namespace App\Http\Controllers;

use App\Http\Entity\GalleryImage;
use App\Http\Services\PostService;
use App\MunrfePost;
use App\MunrfePost as Post;
use TCG\Voyager\Voyager;

class PostController
{
    /** @var PostService */
    protected $postService;

    /**
     * PostController constructor.
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        /** @var MunrfePost $post */
        $post = Post::find($id);
        return view('post', [
            'post' => $post,
            'gallery' => $this->postService->prepareGallery($post)
        ]);
    }

}
