<?php

namespace Dot\Seasons\Models;

use DB;
use Dot\Categories\Models\Category;
use Dot\Platform\Model;
use Dot\Posts\Models\Post;
use Dot\Tags\Models\Tag;

/*
 * Class Season
 * @package Dot\Seasons\Models
 */
class Season extends Model
{

    /*
     * @var bool
     */
    public $timestamps = false;
    /*
     * @var string
     */
    protected $table = "seasons";
    /*
     * @var string
     */
    protected $primaryKey = 'id';
    /*
     * @var array
     */
    protected $searchable = ['name'];
    /*
     * @var int
     */
    protected $perPage = 20;
    /*
     * @var array
     */
    protected $creatingRules = [
        "name" => "required",
        "category_id" => "required"
    ];

    /*
     * @var array
     */
    protected $updatingRules = [
        "name" => "required",
        "category_id" => "required"
    ];

    /*
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
    }

    /*
     * @param $v
     * @return mixed
     */
    function setValidation($v)
    {
        $v->setCustomMessages((array)trans('seasons::validation'));
        $v->setAttributeNames((array)trans("seasons::seasons.attributes"));
        return $v;
    }

    /*
     * @param $value
     */
    function getCountAttribute($value)
    {
        return $this->posts()->count();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, "seasons_categories", "season_id", "category_id");
    }

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    /*
     * Posts relation
     * @return mixed
     */
    public function posts()
    {
        return $this->hasMany(Post::class)->where('status', 1);
    }

    /*
     * Remove post from season
     * @param $post
     * @return bool
     */
    public function removePost($post)
    {

        if (!is_object($post) || count($post) == 0) {
            return false;
        }

        $this->posts()->detach($post->id);

    }

}
