<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    public $timestamps = false;
    const UPDATED_AT = false;

    protected $fillable = [     
        'announcement',
        'date_added',
    ];
}
