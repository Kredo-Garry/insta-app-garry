<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment; //This (Comment.php) model represent the comments table
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment) {
        $this->comment = $comment;
    }

    public function store(Request $request, $post_id) {
        // Validate the comment input based on the $post_id parameter
        $request->validate([
            'comment_body'.$post_id => 'required|max:150'
        ],
        [
            'comment_body'.$post_id.'.required' => 'You cannot submit an empty comment.',
            'comment_body'.$post_id.'.max' => 'The comment must not have more than 150 characters.'
        ]
        );

        // Set the 'body' attribute of the comment from the request input
        $this->comment->body = $request->input('comment_body'.$post_id);
        // 'comment_body'.$post_id to make sure that the comment is related to the post

        // Set the 'user_id' attribute of the comment to the authenticated User's ID
        $this->comment->user_id = Auth::user()->id;
       
        // Set the 'post_id' attribute of the comment to the value of $post_id
        $this->comment->post_id = $post_id;

        // Save the comment to the database
        $this->comment->save();

        // Redirect back to the previous page
        return redirect()->back();
    }

    # Destroy/delete a comment
    public function destroy($id){
        $this->comment->destroy($id);
        # Same as: "DELETE * FROM comments WHERE id = $id";

        return redirect()->back();
        # redirect the user to the same page
    }
}
