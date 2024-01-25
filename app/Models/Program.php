<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $fillable=['title','description','duration','image','level_id'];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id', 'id');
    }

}
