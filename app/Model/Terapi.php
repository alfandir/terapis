<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Terapi extends Model
{
    use SoftDeletes;

    protected $table = 'terapis';

    protected $fillable = [
        'name',
        'keluhan',
        'catatan',
        'status',
        'created_at'
    ];
}
