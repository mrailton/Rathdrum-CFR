<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AMPDSCode extends Model
{
    protected $table = 'ampds_codes';
    protected $fillable = ['code', 'description', 'arrest_code'];

    protected $casts = [
        'arrest_code' => 'boolean',
    ];
}
