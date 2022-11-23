<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DefibInspection extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['member_id', 'inspected_at', 'pads_expire_at', 'battery_expires_at', 'notes'];

    protected $casts = [
        'inspected_at' => 'date:Y-m-d',
        'pads_expire_at' => 'date:Y-m-d',
        'battery_expires_at' => 'date:Y-m-d',
    ];
}
