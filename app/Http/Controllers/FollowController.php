<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Follow; //this represents the follows table

class FollowController extends Controller
{
    private $follow;

    public function __construct(Follow $follow){
        $this->follow = $follow;
    }

    public function store($user_id){
        $this->follow->follower_id = Auth::user()->id; // the follower user
        $this->follow->following_id = $user_id;        // the user being followed
        $this->follow->save();                         // save to the follows table

        return redirect()->back(); //return to the same page
    }

    public function destroy($user_id){
        $this->follow
            ->where('follower_id', Auth::user()->id)
            ->where('following_id', $user_id)
            ->delete();

            return redirect()->back();
    }
}
