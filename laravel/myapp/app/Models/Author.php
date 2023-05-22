<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

// use Illuminate\Database\Eloquent\Relations\HasOne;

class Author extends Model
{
    use HasFactory;

    protected $fillable=['name','book'];

    public function profiles() :HasOne
    {
        return $this->hasOne(Profile::class);

    }

    // public function profiles() :HasMany
    // {
    //     return $this->hasMany(Profile::class);

    // }

// /**
//  * Get all of the comments for the Author
//  *
//  * @return \Illuminate\Database\Eloquent\Relations\HasMany
//  */
// public function comments(): HasMany
// {
//     return $this->hasMany(Comment::class, 'foreign_key', 'local_key');
// }

}
