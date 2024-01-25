<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = ['logo', 'favicon', 'footer_logo', 'logo_height', 'logo_width', 'google_map'];
}
