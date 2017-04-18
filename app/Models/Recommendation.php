<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\Route;
use Subbe\Semantics3\Semantics3;
use Laravel\Scout\Searchable;


class Recommendation extends Model
{
    use HasSlug;
    use SoftDeletes;
    use Searchable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'recommendations';

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
    protected $fillable = ['department_id','user_id','title','excerpt','body','image','status','created_at','upc','amazon_link','intent'];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];
    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'recommendations_index';
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
          'body' => $this->body,
          'upc' => $this->upc,
          'amazon_link' => $this->amazon_link
        ];
    }


    public function getRouteKeyName() {
        return 'slug';
    }




    public function department()
    {
        return $this->hasOne('App\Models\Department'); //,'id','department_id'
    }

    public function user()
    {
        return $this->belongsTo('App\User');
        //return $this->belongsTo('App\User', 'foreign_key', 'other_key');
    }

    public function catalog()
    {
        return $this->hasOne('App\Models\Catalog');
        //return $this->belongsTo('App\User', 'foreign_key', 'other_key');
    }


    protected $appends = [
        'created_at_ago',
        'updated_at_ago'
    ];

    public function getCreatedAtAgoAttribute() {
        return $this->created_at->diffForHumans();
    }

    public function getUpdatedAtAgoAttribute() {
        return $this->updated_at->diffForHumans();
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate()
            ->slugsShouldBeNoLongerThan(250);
    }


    public static function productLookup($code)
    {
        $sem = new Semantics3();
        //$search = $sem->search('iphone');
        $upc = $sem->upc('0885909950942');
        dd($upc);
        //$site = $sem->site_query('iphone', 'amazon.com');
        //$site = $sem->categories('hard drives');
    }




    public static function boot()
    {
        parent::boot();
            /*
            Route::bind('/show/{slug}', function ($value) {
                dd($value);
                return $this::where('slug', $value)->first();
            });
            */
            Route::bind('user', function ($value) {
                return Post::where('id', $value)
                    ->orWhere('slug', $value)
                    ->first();
            });

            //Route::get('/show/{slug}','RecommendationsController@show')
            //      ->name('recommendations.recommendation.show');

        static::creating(function($model)
       {
            //$userid = (!Auth::guest()) ? Auth::user()->id : null ;
            //$model->created_by = $userid;
            //$model->updated_by = $userid;
        });

        static::updating(function($model)
        {
            //$userid = (!Auth::guest()) ? Auth::user()->id : null ;
            //$model->updated_by = $userid;
        });
    }


    //truncate a string only at a whitespace (by nogdog)
    public static function truncate($text, $length = 100)
    {
       $length = abs((int)$length);
       if(strlen($text) > $length) {
          $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
       }
       return($text);
    }

    // original code: http://www.daveperrett.com/articles/2008/03/11/format-json-with-php/
    // adapted to allow native functionality in php version >= 5.4.0

    /**
    * Format a flat JSON string to make it more human-readable
    *
    * @param string $json The original JSON string to process
    *        When the input is not a string it is assumed the input is RAW
    *        and should be converted to JSON first of all.
    * @return string Indented version of the original JSON string
    */
    public static function json_format($json) {
      if (!is_string($json)) {
        if (phpversion() && phpversion() >= 5.4) {
          return json_encode($json, JSON_PRETTY_PRINT);
        }
        $json = json_encode($json);
      }
      $result      = '';
      $pos         = 0;               // indentation level
      $strLen      = strlen($json);
      $indentStr   = "\t";
      $newLine     = "\n";
      $prevChar    = '';
      $outOfQuotes = true;

      for ($i = 0; $i < $strLen; $i++) {
        // Speedup: copy blocks of input which don't matter re string detection and formatting.
        $copyLen = strcspn($json, $outOfQuotes ? " \t\r\n\",:[{}]" : "\\\"", $i);
        if ($copyLen >= 1) {
          $copyStr = substr($json, $i, $copyLen);
          // Also reset the tracker for escapes: we won't be hitting any right now
          // and the next round is the first time an 'escape' character can be seen again at the input.
          $prevChar = '';
          $result .= $copyStr;
          $i += $copyLen - 1;      // correct for the for(;;) loop
          continue;
        }

        // Grab the next character in the string
        $char = substr($json, $i, 1);

        // Are we inside a quoted string encountering an escape sequence?
        if (!$outOfQuotes && $prevChar === '\\') {
          // Add the escaped character to the result string and ignore it for the string enter/exit detection:
          $result .= $char;
          $prevChar = '';
          continue;
        }
        // Are we entering/exiting a quoted string?
        if ($char === '"' && $prevChar !== '\\') {
          $outOfQuotes = !$outOfQuotes;
        }
        // If this character is the end of an element,
        // output a new line and indent the next line
        else if ($outOfQuotes && ($char === '}' || $char === ']')) {
          $result .= $newLine;
          $pos--;
          for ($j = 0; $j < $pos; $j++) {
            $result .= $indentStr;
          }
        }
        // eat all non-essential whitespace in the input as we do our own here and it would only mess up our process
        else if ($outOfQuotes && false !== strpos(" \t\r\n", $char)) {
          continue;
        }

        // Add the character to the result string
        $result .= $char;
        // always add a space after a field colon:
        if ($outOfQuotes && $char === ':') {
          $result .= ' ';
        }

        // If the last character was the beginning of an element,
        // output a new line and indent the next line
        else if ($outOfQuotes && ($char === ',' || $char === '{' || $char === '[')) {
          $result .= $newLine;
          if ($char === '{' || $char === '[') {
            $pos++;
          }
          for ($j = 0; $j < $pos; $j++) {
            $result .= $indentStr;
          }
        }
        $prevChar = $char;
      }

      return $result;
    }


}
