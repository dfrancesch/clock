<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Time;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TimeThumbnail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'time:thumb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $times = Time::all();
        
        foreach( $times as $t ) {
            $file_name = $t->picture;

            $file_thumb = pathinfo($file_name, PATHINFO_FILENAME) . '-thumb.' . pathinfo($file_name, PATHINFO_EXTENSION);
            
            if (! Storage::exists('times/' . $file_thumb) ) {
                $this->info($file_name. ' - ' . $file_thumb);
                $this->make_thumb(Storage::path('times/'.$file_name) , Storage::path('times/'.$file_thumb), 200 );
            }

        }

        return 0;
    }

    function make_thumb($src, $dest, $desired_width) {

        /* read the source image */
        $source_image = imagecreatefromjpeg($src);
        $width = imagesx($source_image);
        $height = imagesy($source_image);
    
        /* find the "desired height" of this thumbnail, relative to the desired width  */
        $desired_height = floor($height * ($desired_width / $width));
    
        /* create a new, "virtual" image */
        $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
    
        /* copy source image at a resized size */
        imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
    
        /* create the physical thumbnail image to its destination */
        imagejpeg($virtual_image, $dest);
    }
}
