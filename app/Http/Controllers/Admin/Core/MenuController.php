<?php


namespace App\Http\Controllers\Admin\Core;

use Illuminate\Support\Arr;
use TCG\Voyager\Facades\Voyager;
use \TCG\Voyager\Http\Controllers\VoyagerMenuController;

class MenuController extends VoyagerMenuController
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function builder($id)
    {
        $menu = Voyager::model('Menu')->findOrFail($id);
        $this->authorize('edit', $menu);
        $isModelTranslatable = is_bread_translatable(Voyager::model('MenuItem'));
        $test = compact('menu', 'isModelTranslatable');
        return Voyager::view('admin.builder', compact('menu', 'isModelTranslatable'));
    }

    public function prepareParameters($parameters)
    {
        switch (Arr::get($parameters, 'type')) {
            case 'route':
                $parameters['url'] = null;
                break;
            default:
                $parameters['route'] = null;
                $parameters['parameters'] = '';
                break;
        }

        if (isset($parameters['type'])) {
            unset($parameters['type']);
        }

        $parameters['members_only'] = (boolean) $parameters['members_only'];
        return $parameters;
    }
}
