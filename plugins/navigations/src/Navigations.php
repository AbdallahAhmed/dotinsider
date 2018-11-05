<?php

namespace Dot\Navigations;

use Illuminate\Support\Facades\Auth;
use Navigation;

class Navigations extends \Dot\Platform\Plugin
{

    protected $permissions = [
        "manage"
    ];

    /*
     * Plugin bootstrap
     * Called in system boot
     */
    function boot()
    {

        parent::boot();

        Navigation::menu("sidebar", function ($menu) {

            if (Auth::user()->can("blocks.manage")) {
                $menu->item('navigations', trans("navigations::navigations.module"), route("admin.navigations.show"))
                    ->order(1)
                    ->icon("fa-th-large");
            }

        });
    }

    /*
     * Plugin install
     * Running plugin migrations and default options
     */
    function install($command)
    {
        parent::install($command);
    }

    /*
     * Plugin uninstall
     * Rollback plugin installation
     */
    function uninstall($command)
    {
        parent::uninstall($command);
    }

}


