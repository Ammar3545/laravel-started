<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class groub2 extends Model
{
    use HasFactory;

    public function groub1():BelongsToMany
    {
        return $this->belongsToMany(groub1::class,groubBetween::class);

    }
}
