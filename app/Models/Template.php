<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $table = 'templates';
    
    protected $fillable = [
        'user_id',
        'name',
        'template_id',
    ];

    public function user() {
        return $this->belongsTo('App\Models\Wpuser', 'user_id');
    }
}
