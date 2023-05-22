<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
    ];

    public function students() :HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function levels() :BelongsToMany
    {
        return $this->belongsToMany(Level::class,LevelSection::class);
    }
}
