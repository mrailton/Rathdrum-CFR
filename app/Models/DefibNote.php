<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DefibNote extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'note'];
}
