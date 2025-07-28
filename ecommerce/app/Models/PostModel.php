<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    protected $table = 'post_section';
    protected $fillable = [
        'heading',
        'description',
        'post_image'
    ];
}
