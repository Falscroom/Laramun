<?php


namespace App\Http\Entity;


class GalleryImage
{
    /** @var string */
    public $image;

    /** @var string */
    public $preview;

    /** @var string */
    public $width;

    /** @var string */
    public $height;

    public function __construct($image, $preview, $dimensions)
    {
        $this->image = $image;
        $this->preview = $preview;
        $this->width = $dimensions[0];
        $this->height = $dimensions[1];
    }
}
