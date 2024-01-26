<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; //class for authentication
use Illuminate\Http\Request;
use App\Models\User; //model that represents users table
use App\Models\Post; //model that represents posts table
use App\Models\Category; //model that represents categories table

class PostController extends Controller
{
    private $user;
    private $post;
    private $category;

    public function __construct(User $user, Post $post, Category $category){
        $this->user = $user;
        $this->post = $post;
        $this->category = $category;
    }

    # This method will open the create.blade.php (Create Post Page) view
    public function create(){
        # We need to retrieve all the categories from the categories table
        # because this is required in creating the post
        $all_categories = $this->category->all(); //get all the categories
        

        # Open the create.blade.php and display the categories in that page
        return view('users.posts.create')->with('all_categories', $all_categories);
    }

    # This method insert the post details into posts table
    public function store(Request $request){
        # 1. Validate the data first
        $request->validate([
            'category' => 'required|array|between:1,3',
            'description' => 'required|min:1|max:1000',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:1048'
        ]);

        # 2. Save the post to post table
        $this->post->user_id = Auth::user()->id; //the owner of the post
        $this->post->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        $this->post->description = $request->description;
        $this->post->save(); //insert that to the Db

        # 3. Save the categories into the category_post PIVOT table
        // Example: if $request->category contains the : Travel, Lifestyle, Food
        foreach ($request->category as $category_id) {
            $category_post[]  = ['category_id' => $category_id];
        }
        $this->post->categoryPost()->createMany($category_post);

        # 4. Go back to homepage
        return redirect()->route('index');
    }

    # Retrieve post details of the specific Post id
    # The $id represents the post id
    public function show($id){
        $post = $this->post->findOrFail($id);

        return view('users.posts.show')->with('post', $post);
    }

    //The route (web.php) will received the $id of the post, and it will pass into the edit method of the PostController
    public function edit($id){
        $post = $this->post->findOrFail($id); //retrieved the post details

        // If the AUTH USER is not the owner of the post, redirect to homepage
        // check the id of the current logged-in user if it's equal to the id of the user who is the 
        // owner of the post
        if (Auth::user()->id != $post->user->id) {  
            return redirect()->route('index');      //homepage
        }

        $all_categories = $this->category->all(); //get all the lists of categories from categories table

        # Get all the categories of this post and save it in an array
        $selected_categories = []; //empty array, it will hold the specific categories of the post later on

        foreach ($post->categorypost as $category_post) {
            //loop over all the list of selected categories, and save it in the array $selected_categoriesp[]
            $selected_categories[] = $category_post->category_id;
        }

        return view('users.posts.edit')
            ->with('post', $post)                                //post details
            ->with('all_categories', $all_categories)            //list of categories from categories table 
            ->with('selected_categories', $selected_categories); //selected categories under the post
    }

    public function update(Request $request, $id) {
        // 1. Validate the data from the form
        $request->validate([
            'category' => 'required|array|between:1,3',
            'description' => 'required|min:1|max:1000',
            'image' => 'mimes:jpg,png,jpeg,gif|max:1048'
        ]);

        // 2. Update the post
        $post = $this->post->findOrFail($id);
        $post->description = $request->description; // Update a new description

        // If there is a new image
        if ($request->image) {
            $post->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        }

        $post->save();

        // 3. Delete all records from category_post related to this post
        $post->categoryPost()->delete();
        // Use the relationship Post::categoryPost() to select the records related to a post
        // Equivalent: DELETE FROM category_post WHERE post_id = $id

        // 4. Save the new categories to category_post table
        foreach ($request->category as $category_id) {
            $category_post[]  = ['category_id' => $category_id];
        }
        $post->categoryPost()->createMany($category_post);

        // 5. Redirect to Show Post Page (to confirm the update)
        return redirect()->route('post.show', $id);

    }

    public function destroy($id) {
        $post = $this->post->findOrFail($id); // DELETE FROM post WHERE id = $id
        $post->forceDelete(); //it will totally removed the post details from the database table
        return redirect()->route('index'); // homepage
    }
}
