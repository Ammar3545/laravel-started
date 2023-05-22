<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    protected $fillable=['author_id','profile_name'];

    public function authors() : BelongsTo
    {
        return $this->belongsTo(Author::class);
        // return $this->belongsTo(Author::class)->withDefault("value"); here if we want to make default value and if the foreign key is nullable
    }
}
