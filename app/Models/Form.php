<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $table = 'forms';
    
    protected $fillable = [
        'user_id',
        'name',
        'path',
    ];

    public function user() {
        return $this->belongsTo('App\Models\Wpuser', 'user_id');
    }
}
