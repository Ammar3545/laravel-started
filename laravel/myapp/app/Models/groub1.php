<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class groub1 extends Model
{
    use HasFactory;

    public function groub2():BelongsToMany
    {
        return $this->belongsToMany(groub2::class,groubBetween::class);

    }
}
