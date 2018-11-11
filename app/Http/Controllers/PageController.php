<?php

namespace App\Http\Controllers;

use Dot\Categories\Models\Category;
use Dot\Pages\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public $data = array();
    /**
     * GET /pages/{slug}
     * @route pages.show
     * @param Request $request
     * @param $slug
     * @return mixed
     * @throws \Throwable
     */
    public function show(Request $request, $slug){
        $this->data['page'] = Page::where('slug', $slug)->firstorfail();
        $this->data['cats'] = Category::whereHas('seasons', function ($query){
           $query->whereHas('posts', function ($query){
               $query->published();
           });
        })->get();
        return view('page-details', $this->data);
    }
}
