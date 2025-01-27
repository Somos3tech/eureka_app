<?php

namespace App\Modules\Parameters\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Typecompany extends Model
{
    use SoftDeletes;

    protected $table = 'typecompanies';

    protected $primarykey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id', 'description', 'user_created_id', 'user_updated_id', 'user_deleted_id',
    ];

    protected $dates = [
        'deleted_at',
    ];
}
