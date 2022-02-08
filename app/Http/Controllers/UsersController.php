<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\User;
use Auth;
                             
class UsersController extends Controller
{
    public function profile($username)
	{
		$user = User::where('username', $username)->first();

        if(!is_null($user)){
            $books = $user->books()->paginate(10);
            return view('frontend.pages.users.show', compact('user', 'books'));
        }
        return redirect()->route('index');
	}   
}
