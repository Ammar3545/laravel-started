<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;
    // protected $table='blog_posts';
    // protected $primaryKey='id';
    protected $fillable=['title','content'];
}
