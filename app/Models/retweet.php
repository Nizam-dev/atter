<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class retweet extends Model
{
    use HasFactory;
    protected $fillable = ['replie',
    'rtwt',
    'tweet_id',
    'retweet_id',
    'postingan_id',
];
}
