<?php

namespace App\Http\Controllers;

use Dot\Posts\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public $data = array();

    public function show(Request $request, $slug)
    {

        $offset = $request->get('offset', 0);
        $limit = $request->get('limit', 12);

        $post = Post::where('slug', '=', $slug)->firstOrFail();

        $this->data['related_posts'] = Post::whereHas('season', function ($query) use ($post) {
            $query->where('season_id', $post->season_id);
        })
            ->where('id', '<>', $post->id)
            ->published()
            ->take($limit)
            ->offset($offset)
            ->orderBy('published_at', 'DESC')
            ->get();

        if ($request->ajax()) {
            return response()->json([
                'view' => view('extensions.index-videos', ['posts' => $this->data['related_posts']])->render(),
                'count' => count($this->data['related_posts'])
            ]);
        }
        $this->data['post'] = $post;

        return view('post', $this->data);
    }

}
