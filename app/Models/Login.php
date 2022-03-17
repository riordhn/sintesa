<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Login extends Authenticatable
{
    protected $table = 'login';

    protected $primaryKey = 'ID_LOGIN';

    public $incrementing = true;

    public $timestamps = false;
}
