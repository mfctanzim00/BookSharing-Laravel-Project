@extends('frontend.layouts.app')

@section('content')

<div class="main-content">

  <div class="login-area page-area">
    <div class="container">
      <div class="row">
          <div class="col-md-8 p-1">
            <div class="profile-tab border p-2">
              <h3 class="">
                My Uploaded books
              </h3>
              
              <hr>
              <div>
                @include('frontend.pages.books.partials.list')
                <div class="books-pagination mt-5">
                    {{ $books->links() }}
                </div>
              </div>

            </div>
          </div>

          <div class="col-md-4 p-1">
            @include('frontend.pages.users.partials.sidebar')
          </div>
      </div>
    </div>
  </div>

</div>

@endsection