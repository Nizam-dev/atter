<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tweet extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tweet',
        'img',
        'postingan_id'
    ];
}
