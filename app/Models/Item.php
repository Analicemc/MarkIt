<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    const AVAILABLE_OPTIONS = ['T', 'F']; 
    protected $fillable = [
        'name',
        'attachment_required',
        'observation_required',
        'image_path',
        'orientation',
        'active',
        'user_id'
    ];


}
