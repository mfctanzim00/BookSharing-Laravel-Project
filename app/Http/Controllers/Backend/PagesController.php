<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\Publisher;

class PagesController extends Controller
{
    public function index()
    {
    	$total_books = count(Book::all());
    	$total_authors = count(Author::all());
    	$total_publishers = count(Publisher::all());
    	$total_categories = count(Category::all());
    // 	return view('backend.layouts.app');
    	return view('backend.pages.index', compact('total_books', 'total_authors', 'total_publishers', 'total_categories'));
    }
}
