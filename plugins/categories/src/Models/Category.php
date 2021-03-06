<?php

namespace Dot\Categories\Models;

use App\CategoryFeature;
use DB;
use Dot\Media\Models\Media;
use Dot\Platform\Model;
use Dot\Seasons\Models\Season;
use Dot\Users\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Lang;

/*
 * Class Category
 * @package Dot\Categories\Models
 */
class Category extends Model
{

    /*
     * @var string
     */
    protected $module = 'categories';

    /*
     * @var string
     */
    protected $table = 'categories';

    /*
     * @var string
     */
    protected $primaryKey = 'id';

    /*
     * @var string
     */
    protected $parentKey = 'parent';

    /*
     * @var array
     */
    protected $fillable = array('*');

    /*
     * @var array
     */
    protected $guarded = array('id');

    /*
     * @var array
     */
    protected $visible = array();

    /*
     * @var array
     */
    protected $hidden = array();

    /*
     * @var array
     */
    protected $searchable = ['name', 'slug'];

    /*
     * @var int
     */
    protected $perPage = 20;

    /*
     * @var array
     */
    protected $sluggable = [
        'slug' => 'name',
    ];

    /*
     * @var array
     */
    protected $creatingRules = [
        "name" => "required|unique:categories,name",
        "slug" => "unique:categories,slug",
        "image_id" => "required",
        "excerpt" => "required"
    ];

    /*
     * @var array
     */
    protected $updatingRules = [
        "name" => "required|unique:categories,name,[id],id",
        "slug" => "required|unique:categories,slug,[id],id",
        "image_id" => "required",
        "excerpt" => "required"
    ];

    /*
     * image relation
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    function image()
    {
        return $this->hasOne(Media::class, "id", "image_id");
    }

    /*
     * user relation
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    function user()
    {
        return $this->hasOne(User::class, "id", "user_id");
    }

    /*
     * categories relation
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    function categories()
    {
        return $this->hasMany(Category::class, 'parent');
    }

    /*
     * @param $query
     * @param int $parent
     */
    function scopeParent($query, $parent = 0)
    {
        $query->where("categories.parent", $parent);
    }

    function seasons(){
        return $this->hasMany(Season::class);
    }

    function getPostsAttribute(){
        $seasons = $this->seasons()->get();

        $posts = new Collection();
        foreach ($seasons as $season){
            $posts = $posts->merge($season->posts);
        }
        return $posts;
    }

    /**
     * Category Path
     * @return string
     */
    public function getPathAttribute()
    {
        return route('category.show', ['slug' => $this->slug]);
    }

    public function category_feature()
    {
        return $this->belongsToMany(Media::class,'category_features','category_id','video_id')->withPivot('image_id');
    }

    public function feature_image()
    {
        return $this->hasMany('App\CategoryFeature','category_id');
    }

    public function category_image()
    {
        return $this->belongsToMany(Media::class,'category_features','category_id','image_id');
    }
}
