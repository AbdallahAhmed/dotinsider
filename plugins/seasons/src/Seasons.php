<?php

namespace Dot\Seasons;

use Illuminate\Support\Facades\Auth;
use Navigation;
use URL;

class Seasons extends \Dot\Platform\Plugin
{

    protected $permissions = [
        "manage"
    ];

    function boot()
    {

        parent::boot();

        Navigation::menu("sidebar", function ($menu) {

            if (Auth::user()->can("seasons.manage")) {
                $menu->item('seasons', trans("seasons::seasons.seasons"), route("admin.seasons.show"))->icon("fa-th-large")->order(1);
            }
            if (Auth::user()->can("posts.manage")) {
                $menu->item('seasons.posts', trans("posts::posts.posts"), route("admin.posts.show"))->icon("fa-newspaper-o")->order(1);
            }

        });
    }
}
