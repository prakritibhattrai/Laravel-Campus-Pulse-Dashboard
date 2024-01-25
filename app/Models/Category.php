<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','parent_id','meta_title','meta_description','status','order'];

    /**
     * Category belongs to one parent
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

     /**
     * Category has children
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * A category can have many blogs
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

}
