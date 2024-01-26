<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Like; // the Like.php -> it represents the likes table

class LikeController extends Controller
{
    private $like;

    public function __construct(Like $like){
        $this->like = $like;
    }

    # This method is use to store the likes of the into the likes table
    public function store($post_id){
        $this->like->user_id =  Auth::user()->id; //the owner of the likes
        $this->like->post_id = $post_id;          //id of the post being liked
        $this->like->save();                      //insert to the Db

        return redirect()->back();                //redirect to the same page
    }

    # This method is going to destroy/delete the likes of the user in the likes table
    public function destroy($post_id){
        $this->like
            ->where('user_id', Auth::user()->id)
            ->where('post_id', $post_id)
            ->delete();

            return redirect()->back();
    }
}
