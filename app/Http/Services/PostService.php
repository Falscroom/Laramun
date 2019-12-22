<?php


namespace App\Http\Services;


use App\Http\Entity\GalleryImage;
use App\User;
use App\MunrfePost;
use Illuminate\Contracts\Pagination\Paginator;
use TCG\Voyager\Voyager;

class PostService
{
    /** @var Voyager */
    protected $voyager;

    public function __construct(Voyager $voyager)
    {
        $this->voyager = $voyager;
    }

    /**
     * @param Paginator $posts
     */
    public function populateWithUsers(Paginator $posts)
    {
        $user_ids = [];
        $user_map = [];
        foreach ($posts as $post) {
            $user_ids[] = $post->user_id;
        }
        $user_ids = array_unique($user_ids);
        $users = User::whereIn('id', $user_ids)->get();
        foreach ($users as $user) {
            $user_map[$user->id] = $user;
        }
        foreach ($posts as $post) {
            $post->setUser($user_map[$post->user_id]);
        }
    }

    /**
     * @param MunrfePost $post
     * @return array
     */
    public function prepareGallery(MunrfePost $post)
    {
        $galleryDimensions = $post->getDimensions();
        foreach (json_decode($post->gallery) as $key => $item) {
            $gallery[] = new GalleryImage(
                $this->voyager->image($item),
                $this->voyager->image($post->getThumbnail($item,MunrfePost::PREVIEW_NAME)),
                $galleryDimensions[$key]
            );
        }
        return $gallery ?? [];
    }

    /**
     * @param MunrfePost $post
     * @return string
     */
    public function prepareImage(MunrfePost $post)
    {
        return $this->voyager->image($post->image);
    }

    /**
     * @param MunrfePost $post
     * @return string
     */
    public function preparePreview(MunrfePost $post)
    {
        return $this->voyager->image($post->thumbnail(MunrfePost::PREVIEW_NAME));
    }

    /**
     * @param MunrfePost $post
     * @return string
     */
    public function prepareContent(MunrfePost $post)
    {
        $content = strip_tags($post->content);
        return substr($content, 0, strpos($content, ' ', 600)) . (strlen($content) > 600 ? '...' : '');
    }
}
