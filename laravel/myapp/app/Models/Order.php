<?php

namespace App\Models;

use App\Events\OrderPlaced;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $dispatchesEvents=[ // this array to spicify witch lequent want to dipatch(treger) with event
        'created'=>OrderPlaced::class,
    ];
}
