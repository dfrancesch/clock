<?php

namespace App\Http\Api;

use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TimeController {

    public function get( $time ) {
        Log::debug(__METHOD__ . ' - Request : ' . $time );

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

}
