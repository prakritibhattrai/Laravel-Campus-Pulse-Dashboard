<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable=['title','description','image','status','category_id'];


    public function galleryCategory()
    {
        return $this->belongsTo(GalleryCategory::class, 'category_id', 'id');
    }

}
