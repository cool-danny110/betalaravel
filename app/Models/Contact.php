<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';
    
    protected $fillable = [
        'group_id',
        'email',
        'lastname',
        'firstname',
        'sms',
        'whatsapp',
        'double_opt_in',
        'opt_in'
    ];

    public function group() {
        return $this->belongsTo('App\Models\Group', 'group_id');
    }
}
