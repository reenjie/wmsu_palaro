<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tally extends Model
{
    use HasFactory;
    public $timestamps = false;
    const UPDATED_AT = false;
    protected $fillable = [
        'team', 
        'sports_id',
        'user_id',
        'match_id',
        'isofficial',
        'tally',
    ];
}
