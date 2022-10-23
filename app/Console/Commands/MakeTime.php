<?php

namespace App\Console\Commands;

use App\Models\Time;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use stdClass;

class MakeTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:time {time} {file}';

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
        $time   = $this->argument('time');
        $file   = $this->argument('file');

        $nt = new Time();

        $nt->time = $time;
        $nt->user_id = 1;
        $nt->country_code = 'ar';
        $nt->picture = $time.'.jpg';
        $nt->original_picture = $time.'.jpg';
        $nt->description = '';

        $nt->save();

        $picture_file_name = $time .'-'. $nt->id . '.jpg';
        $original_picture_file_name = $time .'-'. $nt->id . '-original.jpg';

        $nt->picture = $picture_file_name;
        $nt->original_picture = $original_picture_file_name;

        $nt->save();

        $file_path = storage_path('download/'.$file );

        $picture_path = Storage::path('times/'. $picture_file_name );
        $original_picture_path = Storage::path('times/'. $original_picture_file_name );

        copy($file_path, $picture_path);
        copy($file_path, $original_picture_path);
        
        unlink( $file_path );

        $this->info( 'picture name    : '. $nt->picture );
        $this->info( 'original picture: '. $nt->original_picture );

        return 0;
    }
}
