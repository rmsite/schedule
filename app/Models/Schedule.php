<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    public $fillable = [
        'foundation_id',
        'title',
        'content',
        'start',
        'end',
        'recurrence'
        
    ];
}
