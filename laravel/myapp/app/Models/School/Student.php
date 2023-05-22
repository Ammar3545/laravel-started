<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'birthday',
        'phone',
        'address'
    ];

    public function levels () :BelongsToMany
    {
        return $this->belongsToMany(Level::class,StudentLevel::class);
    }

    public function subjects() :BelongsToMany
    {
        return $this-> belongsToMany(Subject::class,StudentSubject::class);
    }

    public function sections() :BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}
