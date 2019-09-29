<?php


namespace App\Http\Services;


use App\Http\Entity\GalleryImage;
use App\MunrfePost;
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
        return substr($content, 0, 600) . (strlen($content) > 600 ? '...' : '');
    }
}
