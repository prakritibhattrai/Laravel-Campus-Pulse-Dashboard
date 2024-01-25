<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;
    protected $fillable=['title','description','image','status','category_id'];


    public function researchCategory()
    {
        return $this->belongsTo(ResearchCategory::class, 'category_id', 'id');
    }

}
