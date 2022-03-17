<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Biodata extends Authenticatable
{
    protected $table = 'biodata';

    protected $primaryKey = 'NIK';

    public $incrementing = false;

    public $timestamps = false;
}
