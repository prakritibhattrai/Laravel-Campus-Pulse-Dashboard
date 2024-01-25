<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable=['title','description','image','category_id','file'];

    public function reportCategory()
    {
        return $this->belongsTo(ReportCategory::class, 'category_id', 'id');
    }

}
