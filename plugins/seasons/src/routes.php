<?php

/*
 * WEB
 */

Route::group([
    "prefix" => ADMIN,
    "middleware" => ["web", "auth:backend", "can:blocks.manage"],
    "namespace" => "Dot\\Seasons\\Controllers"
], function ($route) {
    $route->group(["prefix" => "seasons"], function ($route) {
        $route->any('/', ["as" => "admin.seasons.show", "uses" => "SeasonsController@index"]);
        $route->any('/create', ["as" => "admin.seasons.create", "uses" => "SeasonsController@create"]);
        $route->any('/{season_id}/edit', ["as" => "admin.seasons.edit", "uses" => "SeasonsController@edit"]);
        $route->any('/delete', ["as" => "admin.seasons.delete", "uses" => "SeasonsController@delete"]);
        $route->any('/search', ["as" => "admin.seasons.search", "uses" => "SeasonsController@search"]);
        $route->any('/search', ["as" => "admin.seasons.search", "uses" => "SeasonsController@search"]);
    });
});
