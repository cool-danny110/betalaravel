<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $table = 'campaigns';
    
    protected $fillable = [
        'user_id',
        'name',
        'from_email',
        'from_name',
        'reply_to',
        'name_to',
        'receiver_emails',
        'subject_line',
        'preview_text',
        'template_id',
        'active_google_analytics',
        'embed_images',
        'add_tag',
        'add_attachment',
        'custom_unsubscribe',
        'update_profile_form',
        'enable_mirror'
    ];

    public function template() {
        return $this->belongsTo('App\Models\Template', 'template_id');
    }
}

