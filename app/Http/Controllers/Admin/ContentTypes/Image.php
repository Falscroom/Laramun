<?php

namespace App\Http\Controllers\Admin\ContentTypes;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image as InterventionImage;
use TCG\Voyager\Http\Controllers\ContentTypes\BaseType;

class Image extends BaseType
{
    /** @var string */
    protected $path;
    /** @var null|int */
    protected $resize_width = null;
    /** @var null|int */
    protected $resize_height = null;
    /** @var null|int */
    protected $resize_quality;

    public function handle()
    {
        if( $this->row == null && $this->request->file) {
            $file = $this->request->file;
            $path = $this->slug.DIRECTORY_SEPARATOR;
        } else {
            $file = $this->request->file($this->row->field);
            $path = $this->slug.DIRECTORY_SEPARATOR.date('FY').DIRECTORY_SEPARATOR;
        }

        if ($file) {

            $filename = mb_substr($file->getClientOriginalName(),0,strpos($file->getClientOriginalName(),'.'));

            $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();

            if ($file->getClientOriginalExtension() == 'svg') {
                Storage::disk(config('voyager.storage.disk'))->put($fullPath, file_get_contents($file), 'public');
                return $fullPath;
            } else {
                $image = $this->resizeImage($file);
            }

            if ($this->is_animated_gif($file)) {
                Storage::disk(config('voyager.storage.disk'))->put($fullPath, file_get_contents($file), 'public');
                $fullPathStatic = $path.$filename.'-static.'.$file->getClientOriginalExtension();
                Storage::disk(config('voyager.storage.disk'))->put($fullPathStatic, (string) $image, 'public');
            } else {
                Storage::disk(config('voyager.storage.disk'))->put($fullPath, (string) $image, 'public');
            }

            if (isset($this->options->thumbnails)) {
                foreach ($this->options->thumbnails as $thumbnails) {
                    if (isset($thumbnails->name) && isset($thumbnails->scale)) {
                        $scale = intval($thumbnails->scale) / 100;
                        $thumb_resize_width = $this->resize_width;
                        $thumb_resize_height = $this->resize_height;

                        if (isset($thumbnails->resize)) {
                            $thumb_resize_width = null;
                            $thumb_resize_height = null;

                            if (isset($thumbnails->resize->width)) {
                                $thumb_resize_width = $thumbnails->resize->width;
                            }
                            if (isset($thumbnails->resize->height)) {
                                $thumb_resize_height = $thumbnails->resize->height;
                            }
                        }

                        if ($thumb_resize_width != null && $thumb_resize_width != 'null') {
                            $thumb_resize_width = intval($thumb_resize_width * $scale);
                        }

                        if ($thumb_resize_height != null && $thumb_resize_height != 'null') {
                            $thumb_resize_height = intval($thumb_resize_height * $scale);
                        }

                        $image = InterventionImage::make($file)->resize(
                            $thumb_resize_width,
                            $thumb_resize_height,
                            function (Constraint $constraint) {
                                $constraint->aspectRatio();
                                if (isset($this->options->upsize) && !$this->options->upsize) {
                                    $constraint->upsize();
                                }
                            }
                        )->encode($file->getClientOriginalExtension(), $this->resize_quality);
                    } elseif (isset($thumbnails->crop->width) && isset($thumbnails->crop->height)) {
                        $crop_width = $thumbnails->crop->width;
                        $crop_height = $thumbnails->crop->height;
                        $image = InterventionImage::make($file)
                            ->fit($crop_width, $crop_height)
                            ->encode($file->getClientOriginalExtension(), $this->resize_quality);
                    }

                    Storage::disk(config('voyager.storage.disk'))->put(
                        $path.$filename.'-'.$thumbnails->name.'.'.$file->getClientOriginalExtension(),
                        (string) $image,
                        'public'
                    );
                }
            }

            return $fullPath;
        }
    }

    /**
     * @param UploadedFile $file
     * @return \Intervention\Image\Image
     */
    protected function resizeImage(UploadedFile $file)
    {
        $image = InterventionImage::make($file);

        if (isset($this->options->resize) && (
                isset($this->options->resize->width) || isset($this->options->resize->height)
            )) {
            if (isset($this->options->resize->width)) {
                $this->resize_width = $this->options->resize->width;
            }
            if (isset($this->options->resize->height)) {
                $this->resize_height = $this->options->resize->height;
            }
        } else {
            $this->resize_width = $image->width();
            $this->resize_height = $image->height();
        }

        $this->resize_quality = isset($this->options->quality) ? intval($this->options->quality) : 75;

        return $image->resize(
            $this->resize_width,
            $this->resize_height,
            function (Constraint $constraint) {
                $constraint->aspectRatio();
                if (isset($this->options->upsize) && !$this->options->upsize) {
                    $constraint->upsize();
                }
            }
        )->encode($file->getClientOriginalExtension(), $this->resize_quality);
    }

    private function is_animated_gif($filename)
    {
        $raw = file_get_contents($filename);

        $offset = 0;
        $frames = 0;
        while ($frames < 2) {
            $where1 = strpos($raw, "\x00\x21\xF9\x04", $offset);
            if ($where1 === false) {
                break;
            } else {
                $offset = $where1 + 1;
                $where2 = strpos($raw, "\x00\x2C", $offset);
                if ($where2 === false) {
                    break;
                } else {
                    if ($where1 + 8 == $where2) {
                        $frames++;
                    }
                    $offset = $where2 + 1;
                }
            }
        }

        return $frames > 1;
    }
}
