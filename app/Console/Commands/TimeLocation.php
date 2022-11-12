<?php

namespace App\Console\Commands;

use App\Http\Api\TimeController;
use App\Models\Time;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TimeLocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'time:location';

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
        $times = Time::where( function ($query) {
            $query->whereNull('latitude')
            ->orWhereNull('longitude');} )
            ->get();
        
        foreach( $times as $t ) {
            $file_name = $t->original_picture;
            $file = Storage::path('times/'.$file_name);
            try {
                $gps = TimeController::get_image_location($file);

                $t->latitude = $gps['latitude'];
                $t->longitude = $gps['longitude'];

                $this->info( $t->time . ' - ' . $gps['latitude'].', '.$gps['longitude']);

                $t->save();
            } catch ( Exception $e ) {
                Log::error( __METHOD__ . ' - '. $t->time . ' - Error: '. $e->getMessage() );
                Log::error( __METHOD__ . ' - '. $file );

                $this->error( $t->time . ' - Error: '. $e->getMessage() );
            }

        }

        return 0;
    }
}
