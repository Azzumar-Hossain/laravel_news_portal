<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name', 
        'site_logo', 
        'site_favicon', 
        'top_ad_banner', 
        'top_ad_link',
        'sidebar_ad_banner', 
        'sidebar_ad_link',
        'homepage_ad_banner',
        'homepage_ad_link',
        'contact_address', 
        'contact_phone', 
        'contact_fax', 
        'contact_mobile', 
        'contact_email'
    ];
}