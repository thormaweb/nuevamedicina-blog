<?php

namespace App\Jobs;

use File;
use App\Magazine;
use ImageManager;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessPdfPage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The image file path
     *
     * @var [type]
     */
    protected $file;

    /**
     * The magazine id this image belongs to
     *
     * @var [type]
     */
    protected $magId;


    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file, $magId)
    {
        $this->file = $file;
        $this->magId = $magId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $pageNumber = (integer) substr(basename($this->file, ".jpg"),5) + 1; // Take the page number from the file name
        $magazine = Magazine::findOrFail($this->magId);
        $folder = public_path('files/revista/') . $magazine->order;
        $pageName = 'page-'.$pageNumber.'.jpg';
//        $thumbName = 'page-'.$pageNumber.'_thumb.jpg';

        ImageManager::make($this->file)->resize(1080, 1398)->save($folder.'/'.$pageName);
//        ImageManager::make($this->file)->resize(250, 324)->save($folder.'/'.$thumbName);
        File::delete($this->file);

        $magazine->pages()->create([
            'order' => $pageNumber,
            'src' => $magazine->order. '/' . $pageName,
            'thumb' => '',
//            'thumb' => $magazine->order. '/' . $thumbName,
            'title' => 'Page ' . $pageNumber
        ]);
    }
}
