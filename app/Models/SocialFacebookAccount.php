<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialFacebookAccount extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'facebook_id'
    ];
    
    use HasFactory;
}
