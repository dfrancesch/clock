<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimeController extends Controller
{
    static public function getCount() {
        $query = "select count(distinct t.time) as q from times t";

        $rows = DB::select($query);

        return $rows[0]->q;
    }
}
