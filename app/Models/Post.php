<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    # A post belongs to a user
    # To get the owner of the post
    # 1 To Many (Inverse Relationship)
    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }

    # Use this method to get the categories under a post
    public function categoryPost(){
        return $this->hasMany(CategoryPost::class);
    }

    // To retrieve all the comments associated with a post
    public function comments() {
        return $this->hasMany(Comment::class);
        // A post has many comments. With this, we can display all the comments under a post
    }

    # Use this method to get the likes of a post
    public function likes(){
        return $this->hasMany(Like::class);// Like.php --> it represents the likes table
    }

    # This method is going to check if the user already liked the post.
    # If the user already liked the post, we will take the second action as "unlike"
    # If this function returns TRUE, if the Auth use already like the post.
    public function isLiked(){
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
    }
}