<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;
    protected $fillable=['title','description','file','status','category_id'];


    public function resourceCategory()
    {
        return $this->belongsTo(ResourcesCategory::class, 'category_id', 'id');
    }

}
