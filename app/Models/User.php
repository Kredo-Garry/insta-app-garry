<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const ADMIN_ROLE_ID = 1; //admin user
    const USER_ROLE_ID = 2; //regular user

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    # Note: The User.php (Model Class) represents the users table

    # Use this method to get all the posts of a user
    public function posts(){
        return $this->hasMany(Post::class)->latest(); //the latest post will be on top
    }

    # This is a 1 to Many relationship
    # Use this method to get all the followers of a user
    public function followers(){
        return $this->hasMany(Follow::class, 'following_id');
        //following_id can show who are following me (John Smith)
    }

    #Use this method to get all the users that the User if following
    public function following(){
        return $this->hasMany(Follow::class, 'follower_id');
    }

    #this will return True if the user is aleady being followed
    public function isFollowed(){
        return $this->followers()->where('follower_id', Auth::user()->id)->exists();
        # Auth::user()->id -----> is the follower_id
        # Firstly, get all the followers of the user ( $this->followers() ). Then, from that list, search for Auth::user()->id from the follower_id column (Auth::user()->id)
    }
}
