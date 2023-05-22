<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'phone',
        'address',
        'salary'
    ];

    public function levels() :BelongsToMany
    {
        return $this->belongsToMany(Level::class,TeacherLevel::class);
    }

    public function subjects () : HasMany
    {
        return $this->hasMany(Subject::class);
    }
}
