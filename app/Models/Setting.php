<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_url',
        'site_title',
        'copyright',
        'address',
        'contact_number',
        'email',
        'mail_driver',
        'mail_port',
        'mail_host',
        'mail_username',
        'mail_password',
        'mail_from',
        'mail_encryption',
        'cache',
        'minify',
        'use_ssl',
        'app_debug',
        'maintenance',
        'goggle_recaptcha',
        'timezone'
    ];
}
