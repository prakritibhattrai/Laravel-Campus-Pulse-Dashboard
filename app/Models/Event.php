<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable=['title','slug','description','meta_title','meta_description','veneu','start_date','end_date','start_time',
                        'end_time','image','organizer','fee','status'];
}
