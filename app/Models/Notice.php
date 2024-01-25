<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'category_id', 'image'];

    public function noticeCategory()
    {
        return $this->belongsTo('App\NoticeCategory', 'category_id', 'id');
    }
}
