<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;
    public $timestamps = false;
    const UPDATED_AT = false;

    protected $fillable = [
        'sports_id',
        'user_id',
        'CollegeId',
        'date_added',
        'submitted_req',
        'isverified',
        'team',
        'status',
        'batch'
    ];
}
