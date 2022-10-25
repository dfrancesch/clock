<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\UsesUuid;
use App\Models\User;

class Time extends Model {
    use UsesUuid;

    protected $table = 'times';

    protected $uuidColumn = 'uuid';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code', 'code');
    }

}
