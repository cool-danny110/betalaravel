<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';
    
    protected $fillable = [
        'email',
        'lastname',
        'firstname',
        'sms',
        'whatsapp',
        'double_opt_in',
        'opt_in',
        'user_id'
    ];

    
}
