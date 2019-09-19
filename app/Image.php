<?php

namespace App;

use ImageManager;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['url', 'order'];

    /**
     * Return the morpheable model
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function imageable()
    {

        return $this->morphTo();
    }

    /**
     * Return the same query ordered by the order assigned.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return \Illuminate\Database\Query\Builder  $query
     */
    public function scopeOrdered($query)
    {

        return $query->orderBy('order', 'asc');
    }

    /**
     * Format image + Save an image in the public folder
     *
     * @param $request, $type (propiedad / emprendimiento / unidad)
     * @return object (image instance)
     */
    public function procesImage($imageFile, $type, $width = 1200, $height = 600)
    {
        // process and store image
        $imageName = time() . '-' . $imageFile->getClientOriginalName();
        $tempImg = ImageManager::make($imageFile)->widen($width)->heighten($height);
        $file = ImageManager::canvas($width, $height)->insert($tempImg, 'center');
        $file->save(public_path() . '/photos/' . $type . '/' . $imageName);

        // Set $image objet and retunit
        $this->url = $type . '/' . $imageName;

        return $image = $this;
    }
}
