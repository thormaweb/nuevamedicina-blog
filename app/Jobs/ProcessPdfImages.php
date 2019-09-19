<?php

namespace App\Jobs;

use File;
use Imagick;
use Exeption;
use App\Magazine;
use App\MagazinePage;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessPdfImages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The Magazine instance
     *
     * @var [type]
     */
    protected $magazine;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Magazine $magazine)
    {
        $this->magazine = $magazine;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $folder = public_path('files/revista/') . $this->magazine->order;
        if (File::exists($folder)) {
            File::deleteDirectory($folder);
        }
        File::makeDirectory($folder);
        MagazinePage::destroy($this->magazine->pages()->pluck('id')->all());


        // create Imagick object
        // $imagick = new Imagick();
        $imagick = new Imagick(public_path('files/revista/') . $this->magazine->pdf);

        // Sets the image resolution
        $imagick->setResolution(300, 300);
        // $imagick->readImage(public_path('files/revista/') . $this->magazine->pdf);
        $imagick->setImageFormat('jpeg');
        $imagick->setCompression(imagick::COMPRESSION_JPEG);
        $imagick->setImageCompressionQuality(100);


        // Writes images to folder (this will name each new file with Page-01.jpg, Page-02.jpg, etc)
        $imagick->writeImages($folder .'/Page.jpg', false);

        // Free the memory
        $imagick->clear();
        $imagick->destroy();

        $files = File::allFiles($folder);

        // if (count($files) != $imagick->getNumberImages()) {
        //     $this->failed(new Exeption());
        // }

        $magId = $this->magazine->id;
        foreach ($files as $file)
        {
            dispatch(new \App\Jobs\ProcessPdfPage((string) $file, $magId));
        }
    }
}
