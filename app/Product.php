<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Product extends Model
{
    use Searchable;
    use Sluggable;
    use SluggableScopeHelpers;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'vendor_id',
        'name',
        'enable',
        'featured',
        'description',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'category',
        'vendor',
        'colors',
        'rooms',
        'images',
    ];

    /**
     * Relationship with Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    /**
     * Relationship with Vendor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Relationship with Colors
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    /**
     * The relationship with Rooms
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }

    /**
     * Relationship with Images
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {

        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Get images for the product ordered
     *
     * @return mixed
     */
    public function imagesOrdered()
    {
        return $this->images()->ordered()->get();
    }


    /**
     * Get first image as featured
     * @return mixed
     */
    public function featuredImage()
    {
        return $this->images()->ordered()->first();
    }

    /**
     * Get short description
     * @return string
     */
    public function getShortDescription ()
    {
        return strip_tags(str_limit($this->description, 130));
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array['name'] = $this->name;
        $array['featured'] = $this->featured;
        $array['description'] = strip_tags($this->description);
        $array['vendor']['name'] = $this->vendor->pluck('name')[0];
        $array['category']['name'] = $this->category->pluck('name')[0];

        foreach ($this->colors as $index => $color) {
            $array['colors'][$index]['name'] = $color->name;
        }

        foreach ($this->rooms as $index => $room) {
            $array['rooms'][$index]['name'] = $room->name;
        }

        return $array;
    }

    /**
     *
     * Filters and scopes ####################
     *
     */

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('enable', function (Builder $builder) {
            $builder->orderBy('created_at', 'DESC')->where('enable', 1);
        });
    }

    /**
     * Order by last modified for sitemap generation.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLastModified($query)
    {
        return $query->orderBy('updated_at', 'DESC');
    }

    /**
     * Scope a query to order by featured.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFeaturedFirst($query)
    {
        return $query->orderBy('featured', 'DESC');
    }

    /**
     * Scope a query to order by featured.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasRoom($query, $roomId)
    {
        return $query->whereHas('rooms', function ($q) use ($roomId) {
            $q->where('id', $roomId);
        });
    }

    /**
     * Scope a query to order by featured.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasColor($query, $colorId)
    {
        return $query->whereHas('colors', function ($q) use ($colorId) {
            $q->where('id', $colorId);
        });
    }
}
