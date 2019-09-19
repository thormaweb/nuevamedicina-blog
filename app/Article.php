<?php

namespace App;

use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Article extends Model implements Feedable
{
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
        'name',
        'enable',
        'featured',
        'text',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'category',
        'images',
    ];

    /**
     * Relationship with Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(ArticleCategory::class);
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
     * Get first image as featured
     * @return mixed
     */
    public function featuredImage()
    {
        return $this->images()->ordered()->first();
    }

    public function publishedAt()
    {
        setlocale(LC_TIME, 'es_ES.utf8');
        return $this->created_at->formatLocalized('%d de %B, %Y');
    }

    /**
     * Get short description
     * @return string
     */
    public function getShortDescription ()
    {
        return strip_tags(str_limit($this->text, 130));
    }

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

    public function toFeedItem()
    {
        return FeedItem::create([
            "id" => $this->id,
            "title" => $this->name,
            "summary" => $this->getShortDescription(),
            "media" => '/photos/' . $this->featuredImage()->url,
            "updated" => $this->updated_at,
            "link" => '/articulos/' . $this->category->slug . '/' . $this->slug,
            "author" =>'Modo de Vida'
        ]);
    }

    public function getFeed()
    {
        return self::all();
    }
}
