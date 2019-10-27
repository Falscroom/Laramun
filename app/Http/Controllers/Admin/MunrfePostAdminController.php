<?php

namespace App\Http\Controllers\Admin;

use App\MunrfePost;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\Core\VoyagerBaseController;

class MunrfePostAdminController extends VoyagerBaseController
{
    /***
     * @param $request Request
     * @param $slug string
     * @param $rows Collection
     * @param $model MunrfePost
     * @return MunrfePost
    */
    public function insertUpdateData($request, $slug, $rows, $model)
    {
        $realPath = Storage::disk(config('voyager.storage.disk'))->getDriver()->getAdapter()->getPathPrefix();
        foreach ($rows as $row) {
            $content = $this->getContentBasedOnType($request, $slug, $row, $row->details);
            if($row->field == 'gallery') {
                $images = json_decode($content);
                $dimensions = [];
                foreach ($images as $image) {
                    $imageSize = getimagesize($realPath . $image);
                    $dimensions[] = [$imageSize[0], $imageSize[1]];
                }
                $model->gallery_dimensions = json_encode($dimensions);
            }
        }
        return parent::insertUpdateData($request, $slug, $rows, $model);
    }
}
