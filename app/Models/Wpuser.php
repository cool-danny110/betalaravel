<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Wpuser extends Authenticatable
{
    use HasFactory;

    protected $table = 'wp_users';

    // public $fillable =[
    //     'id', ...
    // ]
}
