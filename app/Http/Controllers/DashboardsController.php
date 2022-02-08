<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Category;
use App\Models\BookRequest;

use App\Models\BookAuthor;

class DashboardsController extends Controller
{
	function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
    	$user = Auth::user();

        if(!is_null($user)){
            return view('frontend.pages.users.dashboard', compact('user'));
        }
        return redirect()->route('index');
    }

    public function books()
    {
    	$user = Auth::user();

        if(!is_null($user)){
            $books = $user->books()->paginate(10);
            return view('frontend.pages.users.dashboard_books', compact('user', 'books'));
        }
        return redirect()->route('index');
    }  	

    public function requestBookList()
    {
        $user = Auth::user();

        if(!is_null($user)){
            $book_requests = BookRequest::where('owner_id', $user->id)->orderBy('id', 'desc')->paginate(20);
            return view('frontend.pages.users.request_books', compact('user', 'book_requests'));
        }
        return redirect()->route('index');
    } 

    public function orderBookList()
    {
        $user = Auth::user();

        if(!is_null($user)){
            $book_orders = BookRequest::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(20);
            return view('frontend.pages.users.order_books', compact('user', 'book_orders'));
        }
        return redirect()->route('index');
    } 

    public function bookEdit($slug)
    {
        $book = Book::where('slug', $slug)->first(); 

        $categories = Category::all();
        $publishers = Publisher::all();
        $authors = Author::all();
        $books = Book::where('is_approved', 1)->where('slug', '!=', $slug)->get();
        return view('frontend.pages.users.edit_book', compact('categories', 'publishers', 'authors', 'books', 'book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */     
    public function BookUpdate(Request $request, $slug)
    {
        $book = Book::where('slug', $slug)->first();

        $request->validate([
           'title' => 'required|max:50',
           'category_id' => 'required',
           'publisher_id' => 'required',
           'slug' => 'nullable|unique:books,slug,'.$book->id,
           'description' => 'nullable',
           'image' => 'nullable|image|max:2048'
        ],
        [
            'title.required' => 'Please give book title',
            'image.max' => 'Image size cannot be greater than 2MB'
        ]);

        $book->title = $request->title;

        if(empty($request->slug)) {
            $book->slug = str::slug($request->title);
        }
        else {
            $book->slug = $request->slug;
        }
        $book->category_id = $request->category_id;
        $book->publisher_id = $request->publisher_id;
        $book->publish_year = $request->publish_year;
        $book->description = $request->description;
        // $book->is_approved = 1;
        // $book->user_id = 1;
        $book->isbn = $request->isbn;
        $book->quantity = $request->quantity;
        $book->translator_id = $request->translator_id;

        $book->save();

        //Image Upload
        if($request->image) {
            // Delete Old Image
            if(!is_null($book->image)){
               $file_path = "images/books/".$book->image;
               if(file_exists($file_path)){
                   unlink($file_path);
               }
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $name = time().'-'.$book->id.'.'.$ext;
            $path = "images/books";
            $file->move($path, $name);
            $book->image = $name;
            $book->save();
        }

        //Book Authors
        //delete old authors table data
        $book_authors = BookAuthor::where('book_id', $book->id)->get();
        foreach ($book_authors as $author) {
            $author->delete();
        }
        foreach ($request->author_ids as $id) {
            $book_author = new BookAuthor();
            $book_author->book_id = $book->id;
            $book_author->author_id = $id;
            $book_author->save();
        }

        session()->flash('success', 'Book has been Updated !!');
        return redirect()->route('users.dashboard.books');
    }

    public function requestBook(Request $request, $slug)
    {
        $book = Book::where('slug', $slug)->first();

        $request->validate([
           'user_message' => 'required|max:300'
        ],
        [
            'user_message.required' => 'Please write your message to request the book'
        ]);

        if(!is_null($book)){
            $book_request = new BookRequest();
            $book_request->book_id = $book->id;
            $book_request->user_id = Auth::id();
            $book_request->owner_id = $book->user_id;
            $book_request->status = 1;
            $book_request->user_message = $request->user_message;

            $book_request->save();

            session()->flash('success', 'Book has been Requested to the owner!!');
            return back();
        }
        else{
            session()->flash('error', 'No Book Found!!');
            return back();
        }
    }

    public function requestBookApprove(Request $request, $request_id)
    {
        $book_request = BookRequest::find($request_id);
      
        if(!is_null($book_request)){

            $book_request->status = 2;   //Confirmed By owner
            $book_request->save();
            session()->flash('success', 'Book request has been Approved and sent to the user!!');
            return back();
        }
        else {
            session()->flash('error', 'No Book Found!!');
            return back();
        }
    } 

    public function orderBookApprove(Request $request, $request_id)
    {
        $book_request = BookRequest::find($request_id);
      
        if(!is_null($book_request)){

            $book_request->status = 4;   //Confirmed By User
            $book_request->save();

            $book = Book::find($book_request->book_id);
            $book->decrement('quantity');

            session()->flash('success', 'Book order has been Confirmed!!');
            return back();
        }
        else {
            session()->flash('error', 'No Book Found!!');
            return back();
        }
    } 

    public function requestBookReject(Request $request, $request_id)
    {
        $book_request = BookRequest::find($request_id);

        if(!is_null($book_request)){
            $book_request->status = 3;   //Rejected By owner
            $book_request->save();
            session()->flash('success', 'Book request has been Rejected!!');
            return back();
        }
        else {
            session()->flash('error', 'No Book Found!!');
            return back();
        }
    } 

    public function orderBookReject(Request $request, $request_id)
    {
        $book_request = BookRequest::find($request_id);

        if(!is_null($book_request)){
            $book_request->status = 5;   //Rejected By user
            $book_request->save();
            session()->flash('success', 'Book order has been Rejected!!');
            return back();
        }
        else {
            session()->flash('error', 'No Book Found!!');
            return back();
        }
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bookDelete($id)
    {
        $book = Book::find($id);
        if(!is_null($book)){
            // Delete Old Image
            if(!is_null($book->image)){
               $file_path = "images/books/".$book->image;
               if(file_exists($file_path)){
                   unlink($file_path);
               }
            }
            $book_authors = BookAuthor::where('book_id', $book->id)->get();
            foreach ($book_authors as $author) {
                $author->delete();
            }
            $book->delete();
        }

        session()->flash('success', 'Book Has Been Deleted!!');

        return back();
    }
}
