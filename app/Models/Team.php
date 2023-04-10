<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    public $timestamps = false;
    const UPDATED_AT = false;
    protected $fillable = [
        'sports_id',
        'name',
        'status',
        'maxcount',
        'result',
        'batch'
    ];
}
