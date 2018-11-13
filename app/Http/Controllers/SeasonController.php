<?php

namespace App\Http\Controllers;

use Dot\Seasons\Models\Season;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public $data = array();

    public function posts(Request $request){
        $season_id = $request->get('season_id');
        $season = Season::findOrFail($season_id);

        $this->data['posts'] = $season->posts;

        return response()->json([
            'view' => view('extensions.category-slider',['posts' => $this->data['posts'], "cat" => true])->render(),
            //'view' => view('extensions.index-videos',['posts' => $this->data['posts']])->render(),
            'count' => count($this->data['posts'])
        ]);
    }
}
