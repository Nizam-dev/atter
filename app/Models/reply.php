<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reply extends Model
{
    use HasFactory;
    protected $fillable = ['replie',
   'image_replie',
   'komentar_id',
   'user_id',];
}
