<?php

namespace App\Models;

use \Dot\Blocks\Models\Block as Model;
use Dot\Posts\Models\Post;

class Block extends Model
{
    /**
     * Posts relation
     * @return mixed
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, "posts_blocks", "block_id", "post_id")->orderBy('order')->withPivot('order');
    }
}
