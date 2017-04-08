<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Recommendation;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\Route;
use Laravel\Scout\Searchable;



class Catalog extends Model
{

  use HasSlug;
  use SoftDeletes;
  use Searchable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'catalogs';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','title','description','image','status','longitude','latitude','address1','address2','city','state','country','zipcode','catalog_type'];


    protected $guarded = [];

    public function getRouteKeyName() {
        return 'slug';
    }


    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate()
            ->slugsShouldBeNoLongerThan(250);
    }

    public function recommendation()
    {
        return $this->hasMany('App\Models\Recommendation'); //,'id','department_id'
    }


    public function user()
    {
        return $this->belongsTo('App\User');
        //return $this->belongsTo('App\User', 'foreign_key', 'other_key');
    }


    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'catalogs_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        //$array = $this->toArray();
        // Customize array...
        return [
          'title' => $this->title,
          'description' => $this->description,
          'city' => $this->city,
          'state' => $this->state,
          'country' =>  $this->country,
          'zipcode' =>  $this->zipcode,
          'address1' =>  $this->address1,
          'address2' =>  $this->address2
        ];
    }



}
