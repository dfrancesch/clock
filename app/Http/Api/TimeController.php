<?php

namespace App\Http\Api;

use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TimeController {

    public function home( $time = null ) {
        Log::debug(__METHOD__ . ' - Time : ' . ($time)?:'null' );

        return view('home', [ 'time' => $time ]);
    }

    public function get( $time ) {
        Log::debug(__METHOD__ . ' - Time : ' . $time );

        $times = Time::where('time', $time )->get();

        $list = [];

        foreach( $times as $t )  {

            $list[] = [
                'uuid' => $t->uuid,
                'time' => $t->time,
                'picture' => Storage::url('times/'.$t->picture),
                'user_id' => $t->user_id,
                'user' => [
                    'nick_name' => $t->user->nick_name,
                ],
                'country' => $t->country->name,
                'description' => $t->description,
                'latitude' => $t->latitude,
                'longitude' => $t->longitude,
            ];

        }

        return Response(json_encode( $list ), 200)
                ->header('Content-Type', 'application/json');
    }

    public function getList() {

        Log::debug(__METHOD__ . ' - start' );

        $query = "select substring(t.`time`,1,2) as hr, count(distinct t.`time`) as q
                from times t  
                group by substring(t.`time`,1,2)
                order by 1";

        $rows = DB::select($query);

        $hours = [];
        
        foreach ( $rows as $r ) {
            $hours[$r->hr * 1] = $r->q;
        }

        Log::debug(__METHOD__ . "Hours:" . print_r($hours,true));

        return view('hours', [ 'hours' => $hours ]);
    }

    public function getAlbum() {

        Log::debug(__METHOD__ . ' - start' );

        $query = "select t.time as tm, count(distinct t.`time`) as q
                from times t  
                group by t.time
                order by 1";

        $rows = DB::select($query);

        $hours = [];
        
        foreach ( $rows as $r ) {
            $hours[$r->tm] = $r->q;
        }

        Log::debug(__METHOD__ . "Hours:" . print_r($hours,true));

        return view('album', [ 'hours' => $hours ]);

    }

    public function getHour( $hr ) {

        Log::debug(__METHOD__ . ' - Hour : ' . $hr );

        $hr = substr('0'.$hr,-2);
        
        $query = "select substring(t.`time`,3,2) as mi, count(1) as q
                from times t  
                where substring(t.`time`,1,2) = ?
                group by substring(t.`time`,3,2)
                order by 1";

        $rows = DB::select($query, [ $hr ]);

        $minutes = [];
        
        foreach ( $rows as $r ) {
            $minutes[$r->mi * 1] = $r->q;
        }

        Log::debug(__METHOD__ . "- minutes:" . print_r($minutes,true));

        return view('minutes', [ 'hour' => $hr, 'minutes' => $minutes ]);
        

    }

    public function getMinute( $hr, $mi ) {

        Log::debug(__METHOD__ . ' - Hour: '.$hr.' / Minute : ' . $mi );

        $tm = sprintf("%02d%02d", $hr, $mi);

        Log::debug(__METHOD__ . ' - Time: '.$tm );

        $times = Time::where('time', $tm )->get();

        $list = [];

        foreach( $times as $t )  {
            $list[] = [
                'uuid' => $t->uuid,
                'time' => $t->time,
                'picture' => Storage::disk('local')->url('times/'.$t->picture),
                'user_id' => $t->user_id,
                'user' => [
                    'nick_name' => $t->user->nick_name,
                ],
                'description' => $t->description,
            ];

        }

        return view('minute', [ 'hour' => $hr, 'minute' => $mi, 'times' => $list ]);

    }


    protected static function gps2Num($coordPart){
        $parts = explode('/', $coordPart);
        if(count($parts) <= 0)
        return 0;
        if(count($parts) == 1)
        return $parts[0];
        return floatval($parts[0]) / floatval($parts[1]);
    }
    
    /**
     * get_image_location
     * Returns an array of latitude and longitude from the Image file
     * @param $image file path
     * @return multitype:array|boolean
     */
    public static function get_image_location($image = ''){
        $exif = exif_read_data($image, 0, true);
        if($exif && isset($exif['GPS'])){
            $GPSLatitudeRef = $exif['GPS']['GPSLatitudeRef'];
            $GPSLatitude    = $exif['GPS']['GPSLatitude'];
            $GPSLongitudeRef= $exif['GPS']['GPSLongitudeRef'];
            $GPSLongitude   = $exif['GPS']['GPSLongitude'];
            
            $lat_degrees = count($GPSLatitude) > 0 ? self::gps2Num($GPSLatitude[0]) : 0;
            $lat_minutes = count($GPSLatitude) > 1 ? self::gps2Num($GPSLatitude[1]) : 0;
            $lat_seconds = count($GPSLatitude) > 2 ? self::gps2Num($GPSLatitude[2]) : 0;
            
            $lon_degrees = count($GPSLongitude) > 0 ? self::gps2Num($GPSLongitude[0]) : 0;
            $lon_minutes = count($GPSLongitude) > 1 ? self::gps2Num($GPSLongitude[1]) : 0;
            $lon_seconds = count($GPSLongitude) > 2 ? self::gps2Num($GPSLongitude[2]) : 0;
            
            $lat_direction = ($GPSLatitudeRef == 'W' or $GPSLatitudeRef == 'S') ? -1 : 1;
            $lon_direction = ($GPSLongitudeRef == 'W' or $GPSLongitudeRef == 'S') ? -1 : 1;
            
            $latitude = $lat_direction * ($lat_degrees + ($lat_minutes / 60) + ($lat_seconds / (60*60)));
            $longitude = $lon_direction * ($lon_degrees + ($lon_minutes / 60) + ($lon_seconds / (60*60)));
    
            return array('latitude'=>$latitude, 'longitude'=>$longitude);
        }else{
            return false;
        }
    }

    public function getMap( ) {
        Log::debug(__METHOD__ . ' - start' );

        $gps = Time::select('latitude','longitude', 'picture', 'time')
            // ->skip(0)
            // ->take(50)
            ->get()
            ->toArray();
        
        foreach( $gps as $k => $v ) {
            $file_name = $v['picture'];

            $file_thumb = Storage::disk('local')->url('times/'.pathinfo($file_name, PATHINFO_FILENAME) . '-thumb.' . pathinfo($file_name, PATHINFO_EXTENSION));

            $gps[$k]['picture'] = $file_thumb;
        }

        Log::debug(__METHOD__ . ' - list : ' . print_r($gps,true) );

        return view('map', ['gps' => $gps]);
    }



}
