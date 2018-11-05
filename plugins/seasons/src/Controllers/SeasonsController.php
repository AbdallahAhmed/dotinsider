<?php

namespace Dot\Seasons\Controllers;

use Action;
use Dot\Categories\Models\Category;
use Dot\Seasons\Models\Season;
use Dot\Platform\Controller;
use Redirect;
use Request;
use View;

/*
 * Class SeasonsController
 * @package Dot\Seasons\Controllers
 */
class SeasonsController extends Controller
{

    /*
     * View payload
     * @var array
     */
    protected $data = [];

    /*
     * Show all seasons
     * @return mixed
     */
    function index()
    {

        if (Request::isMethod("post")) {
            if (Request::filled("action")) {
                switch (Request::get("action")) {
                    case "delete":
                        return $this->delete();
                }
            }
        }

        $this->data["sort"] = $sort = (Request::filled("sort")) ? Request::get("sort") : "id";
        $this->data["order"] = $order = (Request::filled("order")) ? Request::get("order") : "DESC";
        $this->data['per_page'] = (Request::filled("per_page")) ? (int)Request::get("per_page") : 40;

        $query = Season::orderBy($this->data["sort"], $this->data["order"]);

        if (Request::filled("q")) {
            $query->search(Request::get("q"));
        }

        $seasons = $query->paginate($this->data['per_page']);

        $this->data["seasons"] = $seasons;

        return View::make("seasons::show", $this->data);
    }

    /*
     * Delete season by id
     * @return mixed
     */
    public function delete()
    {
        $ids = Request::get("id");

        $ids = is_array($ids) ? $ids : [$ids];

        foreach ($ids as $id) {

            $season = Season::findOrFail($id);

            // Fire deleting action

            Action::fire("season.deleting", $season);

            $season->categories()->detach();

            // Fire deleted action

            Action::fire("season.deleted", $season);
        }

        return Redirect::back()->with("message", trans("seasons::seasons.events.deleted"));
    }

    /*
     * Create a new season
     * @return mixed
     */
    public function create()
    {

        if (Request::isMethod("post")) {

            $season = new Season();

            $season->name = Request::get("name");
            $season->category_id = Request::get("category_id");

            // Fire Saving season

            Action::fire("season.saving", $season);

            if (!$season->validate()) {
                return Redirect::back()->withErrors($season->errors())->withInput(Request::all());
            }

            $season->save();

            // Fire saved action

            Action::fire("season.saved", $season);

            return Redirect::route("admin.seasons.edit", array("id" => $season->id))
                ->with("message", trans("seasons::seasons.events.created"));
        }

        $this->data["season"] = false;
        $this->data["season_categories"] = collect([]);
        $this->data['categories'] = Category::all();

        return View::make("seasons::edit", $this->data);
    }

    /*
     * Edit season by id
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {

        $season = Season::findOrFail($id);

        if (Request::isMethod("post")) {

            $season->name = Request::get("name");
            $season->category_id = Request::get("category_id");


            // Fire saving action

            Action::fire("season.saving", $season);

            if (!$season->validate()) {
                return Redirect::back()->withErrors($season->errors())->withInput(Request::all());
            }

            $season->save();

            // Fire saved action

            Action::fire("season.saved", $season);

            return Redirect::route("admin.seasons.edit", array("id" => $id))->with("message", trans("seasons::seasons.events.updated"));
        }

        $this->data["season"] = $season;
        $this->data["season_categories"] = $season->categories;
        $this->data['categories'] = Category::all();

        return View::make("seasons::edit", $this->data);
    }

    /*
     * Rest Service to search seasons
     * @return string
     */
    function search()
    {

        $q = trim(urldecode(Request::get("q")));

        $seasons = Season::search($q)->get()->toArray();

        return json_encode($seasons);
    }

}
