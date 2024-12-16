<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'company_name',
        'phone',
        'email',
        'whatsapp_number',
        'telegram_number',
        'fb_page',
        'fb_link',
        'twitter_link',
        'linkdin_link',
        'whatapps_link',
        'address',
        'logo',
        'details',
        'vision',
        'status'
    ];
}
