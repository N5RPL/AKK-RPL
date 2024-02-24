<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id')->select('id', 'nama', 'avatar');
    }

    public function likes() {
        return $this->hasMany(LikesPhoto::class, 'photo_id', 'id');
    }

    public function comments() {
        return $this->hasMany(CommentPhoto::class, 'photo_id', 'id')->with('user')->orderBy('created_at', 'desc');
    }

    public function likedByUser() {
        return $this->hasMany(LikesPhoto::class, 'photo_id', 'id')->where('user_id', auth()->user()->id);
    }
}
