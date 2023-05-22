<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Level extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'capacity',
    ];

    public function students() : BelongsToMany
    {
        return $this->belongsToMany(Student::class,StudentLevel::class);
    }

    public function teachers() : BelongsToMany
    {
        return $this->belongsToMany(Teacher::class,TeacherLevel::class);
    }

    public function sections() :BelongsToMany
    {
         return $this->belongsToMany(Section::class,LevelSection::class);
    }
}
