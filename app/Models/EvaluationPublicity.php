<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvaluationPublicity extends Model
{
    use SoftDeletes;

    protected $table = 'evaluation_publicities';

    protected $primaryKey = 'evaluation_publicity_id';

    public $incrementing = true;

    protected $fillable = [
        'created_by',
        'updated_by',
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
    ];

    public function getCreatedAtAttribute($value){
        return date_format(date_create($value), 'd M Y H:i');
    }
}
