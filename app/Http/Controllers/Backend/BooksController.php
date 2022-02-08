<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Book;
use App\Models\BookAuthor;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('id', 'desc')->get();
        return view('backend.pages.books.index', compact('books'));
    }

    public function unapproved()
    {
        $books = Book::orderBy('id', 'desc')->where('is_approved', 0)->get();
        $approved = true;
        return view('backend.pages.books.index', compact('books', 'approved'));
    }

    public function approved()
    {
        $books = Book::orderBy('id', 'desc')->where('is_approved', 0)->get();
        $approved = false;
        return view('backend.pages.books.index', compact('books', 'approved'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $publishers = Publisher::all();
        $authors = Author::all();
        $books = Book::where('is_approved', 1)->get();
        return view('backend.pages.books.create', compact('categories', 'publishers', 'authors', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'title' => 'required|max:50',
           'category_id' => 'required',
           'publisher_id' => 'required',
           'slug' => 'nullable|unique:books',
           'description' => 'nullable',
           'image' => 'required|image|max:2048',
           'quantity' => 'required|numeric|min:1'
        ],
        [
            'title.required' => 'Please give book title',
            'image.max' => 'Image size cannot be greater than 2MB'
        ]);

        $book = new Book();
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
        $book->is_approved = 1;
        $book->user_id = 1;
        $book->isbn = $request->isbn;
        $book->quantity = $request->quantity;
        $book->translator_id = $request->translator_id;
        $book->quantity = $request->quantity;

        $book->save();

        //Image Upload
        if($request->image) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $name = time().'-'.$book->id.'.'.$ext;
            $path = "images/books";
            $file->move($path, $name);
            $book->image = $name;
            $book->save();
        }

        //Book Authors
        foreach ($request->author_ids as $id) {
            $book_author = new BookAuthor();
            $book_author->book_id = $book->id;
            $book_author->author_id = $id;
            $book_author->save();
        }

        session()->flash('success', 'Book has been Created !!');
        return redirect()->route('admin.books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id); 

        $categories = Category::all();
        $publishers = Publisher::all();
        $authors = Author::all();
        $books = Book::where('is_approved', 1)->where('id', '!=', $id)->get();
        return view('backend.pages.books.edit', compact('categories', 'publishers', 'authors', 'books', 'book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */     
    public function update(Request $request, $id)
    {
        // $category = Book::find($id);

        // $request->validate([
        //    'name' => 'required|max:50',
        //    'slug' => 'nullable|unique:books,slug,'.$category->id,
        //    'description' => 'nullable',
        // ]);

        // $category->name = $request->name;

        // if(empty($request->slug)) {
        //     $category->slug = str::slug($request->name);
        // }
        // else {
        //     $category->slug = $request->slug;
        // }
        // $category->parent_id = $request->parent_id;
        // $category->description = $request->description;
        // $category->save();
        
        // session()->flash('success', 'Book has been Updated !!');

        // return back();
        $book = Book::find($id);
        $request->validate([
           'title' => 'required|max:50',
           'category_id' => 'required',
           'publisher_id' => 'required',
           'slug' => 'nullable|unique:books,slug,'.$book->id,
           'description' => 'nullable',
           'image' => 'nullable|image|max:2048',
           'quantity' => 'required|numeric|min:1'
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
        $book->translator_id = $request->translator_id;
        $book->quantity = $request->quantity;

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
        return redirect()->route('admin.books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // //delete all Child Categories
        // $child_categories = Book::where('parent_id', $id)->get();
        // foreach ($child_categories as $child) {
        //     $child->delete();
        // }

        // $category = Book::find($id);
        // $category->delete();
        // session()->flash('success', 'Book has been Deleted !!');

        $book = Book::find($id);
        if(!is_null($book)){
            // Delete Old Image
            if(!is_null($book->image)){
               $file_path = "images/books/".$book->image;
               if(file_exists($file_path)){
                   unlink($file_path);
               }
            }
            $book_authors = BoookAuthor::where('book_id', $book->id)->get();
            foreach ($book_authors as $author) {
                $author->delete();
            }
            $book->delete();
        }

        session()->flash('success', 'Book Has Been Deleted!!');

        return back();
    }

    public function approve($id)
    {
        $book = Book::find($id);
        if(!is_null($book)){
            $book->is_approved = 1;
            $book->save();
        }

        session()->flash('success', 'Book Has Been Approved!!');

        return back();
    }

    public function unapprove($id)
    {
        $book = Book::find($id);
        if(!is_null($book)){
            $book->is_approved = 0;
            $book->save();
        }

        session()->flash('success', 'Book Has Been Unproved!!');

        return back();
    }
}
