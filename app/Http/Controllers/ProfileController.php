<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; //authentication class
use Illuminate\Http\Request;
use App\Models\User; //this represents the users table


class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function show($id){
        $user = $this->user->findOrFail($id);
        return view('users.profile.show')->with('user', $user);
    }

    public function edit(){
        $user = $this->user->findOrFail(Auth::user()->id);
        return view('users.profile.edit')->with('user', $user);
    }

    public function update(Request $request){
        #1. Validate the data first
        $request->validate([
            'name'          => 'required|min:1|max:50',
            'email'         => 'required|email|max:50|unique:users,email,' . Auth::user()->id,
            'avatar'        => 'mimes:jpeg,jpg,gif,png|max:1048',
            'introduction'  => 'max:100'
        ]);

        #2. Get or received the new updated data coming from the edit.blade.php form
        $user               = $this->user->findOrFail(Auth::user()->id); //the id of the current logged-in user
        $user->name         = $request->name;          //the new name of the user
        $user->email        = $request->email;         //the new email of the user
        $user->introduction = $request->introduction; //the introduction content

        //Check if there is an avatar uploaded
        if ($request->avatar) { //if this true, then new avatar is uploaded
            $user->avatar = 'data:image/' . $request->avatar->extension() . ';base64,' . base64_encode(file_get_contents($request->avatar));
        }

        #3. Save the new data to the users table
        $user->save();

        #3. Redirect the user to the profile page once the update is successful
        return redirect()->route('profile.show', Auth::user()->id);
    }

    public function followers($id){
        $user = $this->user->findOrFail($id);
        return view('users.profile.followers')->with('user', $user);
    }

    public function following($id){
        $user = $this->user->findOrFail($id);
        return view('users.profile.following')->with('user', $user);
    }
}
