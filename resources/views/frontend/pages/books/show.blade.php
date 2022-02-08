@extends('frontend.layouts.app')

@section('content')

<div class="main-content">

  <div class="book-show-area">
    <div class="container">
      @include('frontend.layouts.partials.messages')
      <div class="row">

        <div class="col-md-3">
          
          <img src="{{ asset('images/books/'.$book->image) }}" class="img img-fluid" />
        </div>
        <div class="col-md-9">
          <h3>{{ $book->title }}</h3>
          <p class="text-muted">Written 
            {{-- @foreach($authors as $book_author)
                <span class="text-primary">{{ $book_author->author->name }}</span>
            @endforeach --}}
            @<span class="text-info">{{ $book->category->name }}</span>
          </p>
          <hr>
          <p><strong>Uploaded By: </strong> {{ $book->user->name }} </p>
          <p><strong>Uploaded at: </strong> {{ $book->created_at->diffForHumans() }} </p>

          <p>
            <strong>Published at </strong> {{ $book->publish_year }} <br>
            <strong>Publisher: </strong> {{ $book->publisher->name }} <br>
            <strong>ISBN: </strong> {{ $book->isbn }}
          </p>

          <div class="book-description">
             {!! $book->description !!}
            {{-- This book is to help you to learn Java completely..<br>
           <strong> Including:</strong><br>
            1) Use of essential and advanced features of the Java language<br>
            2) Code Java annotations and inner classes<br>
            3) Work with reflection, generics, and threads<br>
            4) Take advantage of the garbage collector<br>
            5) Manage streams with the Stream API<br> --}}
          </div>

          <div class="book-buttons mt-4">
              {{-- <a href="" class="btn btn-outline-success"><i class="fa fa-check"></i> Already Read</a>
              <a href="book-view.html" class="btn btn-outline-warning"><i class="fa fa-cart-plus"></i> Add to Cart</a>
              <a href="" class="btn btn-outline-danger"><i class="fa fa-heart"></i> Add to Wishlist</a> --}}

              {{-- @auth
                @if(!is_null(App\User::bookRequest($book->id)))
                  @if(App\User::bookRequest($book->id)->status==1)
                    <a href="#requestModal{{$book->id}}" class="btn btn-outline-success" data-toggle="modal"><i class="fa fa-check"></i> Update Request </a>
                  @endif
                @else
                  <a href="#requestModal{{$book->id}}" class="btn btn-outline-success" data-toggle="modal"><i class="fa fa-check"></i> Send Request </a>
                @endif
              @endauth --}}

              <a href="#requestModal{{$book->id}}" class="btn btn-outline-success" data-toggle="modal"><i class="fa fa-check"></i> Send Request </a>

              <!-- Modal -->
             <div class="modal fade" id="requestModal{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">
                             Request for <mark>{{ $book->title }}</mark>
                          </h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                      </div>
                      <div class="modal-body">
                            <form action="{{ route('books.request', $book->slug) }}" method="post">
                               @csrf
                               <p> Send a request to the Owner of this book ? </p>
                               <textarea name="user_message" id="user_message" class="form-control" rows="5" required>  </textarea>

                               <button type="submit" class="btn btn-success mt-4">
                                 <i class="fa fa-send"></i> Send Request Now
                               </button>
                               <button type="submit" class="btn btn-secondary mt-4" data-dismiss="modal"> Cancel </button>
                            </form>
                      </div>
                      
                    </div>
                </div>
             </div>

          </div>
        </div>

      </div>
    </div>
  </div>

</div>

@endsection