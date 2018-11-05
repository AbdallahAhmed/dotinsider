<?php
/**
 * Created by PhpStorm.
 * User: abdallah
 * Date: 27/09/18
 * Time: 10:20 ص
 */


if(!function_exists('nav_url')){
    function nav_url($nav){
        switch ($nav->type) {
            case "url":
                return $nav->link;
            case 'page':
                return \App\Models\Page::find($nav->type_id)->path;
        }
        return route('index')."/".$nav->link;
    }
}
