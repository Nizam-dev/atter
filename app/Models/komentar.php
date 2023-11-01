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

    public function reply()
    {
        return $this->hasMany(reply::class)
        ->join('users','users.id','replies.user_id')
        ->select('replies.*','users.name','users.username','users.foto');
    }
}
