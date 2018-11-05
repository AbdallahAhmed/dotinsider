<?php

namespace App\Models;

use Dot\Pages\Models\Page as Model;

class Page extends Model
{
    /**
     * Path attribute
     * @return string
     */
    public function getPathAttribute()
    {
        return route('pages.show', ['slug' => $this->slug]);
    }
}
