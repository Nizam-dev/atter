<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class postingan extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id'
    ];


    public function likes()
    {
        return $this->hasMany(like::class);
    }
    public function komentar()
    {
        return $this->hasMany(komentar::class);
    }

    public function retweet()
    {
        return $this->hasMany(retweet::class,'tweet_id')
        ->join('postingans','postingans.id','retweets.postingan_id')
        ->select('retweets.*','postingans.user_id');
    }
    
}
