<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;
    protected $fillable=['title','description','image','file','category_id'];


    public function publicationCategory()
    {
        return $this->belongsTo(PublicationCategory::class,'category_id','id');
    }

}
