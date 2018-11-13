<?php

namespace App\Http\Controllers;

use Dot\Categories\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $data = array();

    public function index(Request $request)
    {

        $offset = $request->get('offset', 0);
        $limit = $request->get('limit', 12);

        $categories = Category::whereHas('seasons', function ($query) {
            $query->whereHas('posts', function ($query) {
                $query->published();
            });
        })
            ->offset($offset)
            ->take($limit)
            ->get();

        if ($request->ajax()) {
            $i = 0;
            foreach ($categories as $key => $category) {
                $categories[$i]['thumb'] = thumbnail($category->image->path, 'cat-footer-logo');
                $i++;
            }
            return response()->json([
                'cats' => $categories,
                'count' => count($categories)
            ]);
        }

        $this->data['categories'] = $categories;

        return view('categories', $this->data);
    }

    public function show(Request $request, $slug)
    {

        $offset = $request->get('offset', 0);
        $limit = $request->get('limit', 12);

        $category = Category::where('slug', $slug)->whereHas('seasons', function ($query) {
            $query->whereHas('posts', function ($query) {
                $query->published();
            });
        })->firstOrFail();

        $seasons = $category
            ->seasons()
            ->whereHas('posts', function ($query) {
                $query->published();
            })
            ->get();
        $slider_posts = $seasons[0]->posts;

        $posts = array();
        foreach ($seasons as $season) {
            $posts = array_merge($posts, $season->posts()->get()->all());
        }
        $this->data['posts'] = array_slice($posts, $offset, $limit);
        if ($request->ajax()) {
            return response()->json([
                'view' => view('extensions.index-videos', ['posts' => $this->data['posts']])->render(),
                'count' => count($this->data['posts'])
            ]);
        }

        $this->data['category'] = $category;
        $this->data['seasons'] = $seasons;
        $this->data['slider_posts'] = $slider_posts;

        return view('category', $this->data);
    }

    public function posts(Request $request){
        $id = $request->get('category_id');
        $posts = Category::find($id)->seasons()->first()->posts;
        $this->data['posts'] = $posts;

        return response()->json([
            'view' => view('extensions.category-slider',['posts' => $this->data['posts'], "cat" => false])->render(),
            'count' => count($this->data['posts'])
        ]);
    }


}
