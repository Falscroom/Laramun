<?php

namespace App\Http\Controllers;

use App\MunrfePost;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\MunrfePost as Post;
use App\Meta;

class MainController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(\Request $request)
    {
        /** @var MunrfePost[] $posts */
        $posts = Post::latest()->take(6)->get();
        $meta = Meta::where('route', $request::path())
            ->where('type', 'contact')
            ->orWhere('type', 'partner')
            ->get();

        foreach ($meta as $item) {
            if (in_array($type = $item->type, Meta::VIEW_TYPES)) {
                $partnersContacts[$type][] = $item;
            }
        }

        return view('main',[
            'posts' => $posts,
            'partners' => $partnersContacts['partner'] ?? [],
            'contacts' => $partnersContacts['contact'] ?? []
        ]);
    }
}
