@extends('backend.layouts.app')

@section('admin-content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Book - {{ $book->title }}</h1>
                    </div>
                    @include('backend.layouts.partials.messages')

                    <div class="row">
                      <div class="col-md-12">
                        <form action="{{ route('admin.books.update', $book->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Book Title</label>
                                    <br>
                                    <input type="text" class="form-control" name="title" placeholder="Book Title" value="{{$book->title}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="">Book URL Text</label>
                                    <br>
                                    <input type="text" class="form-control" name="slug" placeholder="Book URL" value="{{$book->slug}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="">Book Category</label>
                                    <br>
                                    <select name="category_id" id="category_id" class="form-control">
                                      <option value=""> Select Category </option>
                                      @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}> {{$category->name}} </option>
                                      @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="">Book Author</label>
                                    <br>
                                    <select name="author_ids[]" id="author_id" class="form-control select2" multiple>
                                      <option value=""> Select Author </option>
                                      @foreach($authors as $author)
                                        <option value="{{ $author->id }}" {{ App\Models\Book::isAuthorSelected($book->id, $author->id) ? 'selected' : '' }}> {{$author->name}} </option>
                                      @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="isbn">Book ISBN</label>
                                    <br>
                                    <input type="text" class="form-control" name="isbn" placeholder="Book ISBN" value="{{$book->isbn}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="">Book Publisher</label>
                                    <br>
                                    <select name="publisher_id" id="publisher_id" class="form-control">
                                      <option value=""> Select Publisher </option>
                                      @foreach($publishers as $publisher)
                                        <option value="{{ $publisher->id }}" {{ $book->publisher_id == $publisher->id ? 'selected' : '' }}> {{$publisher->name}} </option>
                                      @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="">Book Publication Year</label>
                                    <br>
                                    <select name="publish_year" id="publish_year" class="form-control">
                                      <option value=""> Select Publish Year </option>
                                      @for($year=date('Y'); $year>=1900; $year--)
                                         <option value="{{ $year }}" {{ $book->publish_year == $year ? 'selected' : '' }}>
                                           {{ $year }}
                                         </option>
                                      @endfor
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="image">Book Featured Image<a href="{{ asset('images/books/'.$book->image) }}" target="_blank"> Old Image </a></label>
                                    <br> 
                                    <input type="file" name="image" id="image" class="form-control" required> 
                                </div>

                                <div class="col-md-6">
                                    <label for="translator_id">Book Translator</label>
                                    <br>
                                    <select name="translator_id" id="translator_id" class="form-control select2">
                                      <option value=""> Select a Translator Book </option>
                                      @foreach($books as $tb) {{--  tb=translator book --}}
                                        <option value="{{ $tb->id }}"> {{$tb->id == $book->translator_id ? 'selected' : '' }} </option>
                                      @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                  <label for="quantity"> Book Quantity </label>
                                  <br>
                                  <input type="number" class="form-control" name="quantity" placeholder="Book Quantity" value="{{$book->quantity}}" required>
                                </div>
                                
                                <div class="col-12">
                                    <label for="summernote">Book Details</label>
                                    <br>
                                    <textarea name="description" id="summernote" cols="30" rows="5" class="form-control" placeholder="Book Description">{!! $book->description !!}</textarea>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                      </div>
                    </div>

@endsection

