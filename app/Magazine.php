<?php

namespace App;

use Storage;
use ImageManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Magazine extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'order',
        'description',
        'keywords',
        'thumbnail',
        'published_on',
        'pdf',
        'issuu_active',
        'issuu_script',
    ];

    /**
     * Spanish months for editions
     * @var array
     */
    static public $months = [
        '01' => 'Enero',
        '02' => 'Febrero',
        '03' => 'Marzo',
        '04' => 'Abril',
        '05' => 'Mayo',
        '06' => 'Junio',
        '07' => 'Julio',
        '08' => 'Agosto',
        '09' => 'Septiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre',
    ];

    /**
     * Magazine pages
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany(MagazinePage::class);
    }

    /**
     * Get short description
     * @return string
     */
    public function getShortDescription ()
    {
        return str_limit(strip_tags($this->description), 140);
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('published_on', function (Builder $builder) {
            $builder->orderBy('order', 'DESC')
                    ->where('published_on', '<=', \Carbon\Carbon::now()->toDateTimeString());
        });
    }


    /**
     * Format image + Save an image in the public folder
     *
     * @param $imageFile, $name
     */
    public function procesImage($imageFile, $name, $width = 700, $height = 906)
    {
        // process and store image
        $imageName = $name . '-' . time() . '.' . $imageFile->getClientOriginalExtension();
        $tempImg = ImageManager::make($imageFile)->widen($width)->heighten($height);
        $file = ImageManager::canvas($width, $height)->insert($tempImg, 'center');
        $file->save(public_path() . '/files/revista/' . $imageName);
        $this->thumbnail = $imageName;
    }

    /**
     * Name and store PDF
     * @param $pdf, $name
     */
    public function procesPdf($pdfFile, $name)
    {
        $pdfName = $name . '-' . time() . '.' . $pdfFile->getClientOriginalExtension();
        $pdfFile->storeAs('', $pdfName, 'magazine');
        $this->pdf = $pdfName;
    }
}
