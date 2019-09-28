<?php


namespace App\Http\Controllers;

use App\Http\Entity\GalleryImage;
use App\MunrfePost;
use App\MunrfePost as Post;
use TCG\Voyager\Voyager;

class PostController
{
    /** @var Voyager */
    protected $voyager;

    /**
     * PostController constructor.
     * @param Voyager $voyager
     */
    public function __construct(Voyager $voyager)
    {
        $this->voyager = $voyager;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id) {
        /** @var MunrfePost $post */
        $post = Post::find($id);
        $galleryDimensions = $post->getDimensions();
        foreach (json_decode($post->gallery) as $key => $item) {
            $gallery[] = new GalleryImage(
                $this->voyager->image($item),
                $this->voyager->image($post->getThumbnail($item,'preview')),
                $galleryDimensions[$key]
            );
        }
        return view('post', [
            'post' => $post,
            'gallery' => $gallery ?? []
        ]);
    }

}
