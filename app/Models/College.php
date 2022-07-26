<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;
    public $timestamps = false;
    const UPDATED_AT = false;

    protected $fillable = [
        'name',
        'date_register',
    ];
}
