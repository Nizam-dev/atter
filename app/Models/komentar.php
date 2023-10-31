<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class komentar extends Model
{
    use HasFactory;
   protected $fillable =  [
    'comment',
    'postingan_id',
    'user_id',];
}
