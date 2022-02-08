@extends('frontend.layouts.app')
@section('content')
<div class="main-content">


  <div class="top-body pt-4 pb-4">
    <div class="container">

      @if(Session::has('status'))
        <div class="alert alert-success">
          <p>
             {{ Session::get('status') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
              </button>
          </p>
        </div>
      @endif

    </div>
  </div> <!-- End Top Body Links -->

 <div class="book-list-sidebar">
    <div class="container">
      <div class="row">

        <div class="col-md-9">
          <h3>
            @if(isset($searched))
              Searched Book by - <mark> {{$searched}} </mark>
            @else
              Recent Uploaded Books
            @endisset
          </h3>

            @include('frontend.pages.books.partials.list')

            <div class="books-pagination mt-5">
               {{-- {{ $books->links() }} --}}
             </div>

        </div>
         <!-- Book List -->

        <div class="col-md-3">
          <div class="widget">
            <h5 class="mb-2 border-bottom pb-3">
              Categories
            </h5>

            @include('frontend.pages.books.partials.category-sidebar')

          </div> 
          <!-- Single Widget -->

        </div>

         <!-- Sidebar -->

      </div>
    </div>
  </div>

</div>


@endsection