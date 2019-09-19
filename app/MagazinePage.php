<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MagazinePage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'magazine_id',
        'order',
        'src',
        'thumb',
        'title'
    ];

    /**
     * Disabling eloquent timestamps
     */
    public $timestamps = false;

    /**
     * The magazine this page belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function magazine()
    {
        return $this->belongsTo(Magazine::class);
    }

    /**
     * Scope a query to order rooms.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'ASC');
    }
}
