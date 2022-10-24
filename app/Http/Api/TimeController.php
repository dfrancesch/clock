<?php

namespace App\Http\Api;

use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TimeController {

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
                'description' => $t->description,
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

    public function getHour( $hr ) {

        Log::debug(__METHOD__ . ' - Hour : ' . $hr );

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

}
