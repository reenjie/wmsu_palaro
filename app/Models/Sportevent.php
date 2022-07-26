<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sportevent extends Model
{
    use HasFactory;
    public $timestamps = false;
    const UPDATED_AT = false;

    protected $fillable = [
        'name',
        'datestart',
        'dateend',
        'timestart',
        'timeend',
        'description',
        'rules_regulation',
        'requirements',
        'file',
        'nop',
        'nor',
        'CollegeId',
        'date_added',
    ];
}
