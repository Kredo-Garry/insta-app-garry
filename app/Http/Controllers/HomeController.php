<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post; //inherit the post model so that we can use it and access the posts details
use App\Models\User;

class HomeController extends Controller
{

    # What is the main purpose of a controller?
    # A controller serves as brain of the application. All the logic of the application
    # is place here in the controller
    # Actions like ---> a user clicked button, it will perform some calculations
    # render views, retrieved data from the database tables

    private $post;
    private $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $user)
    {
        $this->post = $post; //initializing the post object, so that we can use it to our methods below
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        # How are we going to retrieve all our posts from the posts table?
        # Answer: Implement the line below:
        //$all_posts = $this->post->latest()->get(); //retrieve all posts from the posts table


        # Filtering the homepage
        $home_posts = $this->getHomePosts(); //call the getHomePosts() method
        $suggested_users = $this->getSuggestedUsers();


        # Go to the homepage (home.blade.php) to display the posts details
        // return view('users.home')
        //     ->with('all_posts', $all_posts);


        return view('users.home')
            ->with('home_posts', $home_posts)
            ->with('suggested_users', $suggested_users);
    }

    # Get the posts of the users the the AUTH (Currently logged-in user) is following.
    public function getHomePosts(){
        $all_posts = $this->post->latest()->get(); //get all the posts and sort in descending order
        $home_posts = []; //in case the $home_posts is empty,it will no return NULL, but empty instead

        foreach ($all_posts as $post) {
            if ($post->user->isFollowed() || $post->user->id === Auth::user()->id) {
                $home_posts[] = $post; //if either 1 of the IF CONDITION is true, then save that post to the $home_posts array
            }
        }
        return $home_posts;
    }

    public function getSuggestedUsers(){
        $all_users = $this->user->all()->except(Auth::user()->id);
        $suggested_users = [];

        # Solution 1
        // foreach ($all_users->take(3) as $user) {
        //     if (!$user->isFollowed()) {
        //         $suggested_users[] = $user;
        //     }
        // }

        //return $suggested_users;

        # Solution 2
        foreach ($all_users as $user) {
            if (!$user->isFollowed()) {
                $suggested_users[] = $user;
            }
        }
        
        return array_slice($suggested_users, 0, 5);
        //array_slice(x,y,z)
        //x = array
        //y = offsert / starting index
        //z = length/how many
        
    }

    public function search(Request $request) {
        $users = $this->user->where('name','like','%'.$request->search.'%')->get();
        // Searches for users in the database whose 'name' column partially matches the search term

        # 'name' -> Refers to the column 'name' in the users table
        # 'like' -> Specifies a partial match on the key word or search term
        # '%'.$request->search.'%' -> Represents the search term, enclosed in % sign, idicating that the term can appear at the beginning, middle, or end of the name

        // Send the search result and search term to the users.search for rendering
        return view('users.search')
        ->with('users', $users)
        # Passes the retrieved user data to the view using the varaible name 'users'

        ->with('search', $request->search);
        # Passes the search term to the view using variable name 'search'
    }
}
