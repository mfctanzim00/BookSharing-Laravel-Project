@extends('frontend.layouts.app')

@section('content')

<div class="main-content">

  <div class="login-area page-area">
    <div class="container">
      <div class="row">
          <div class="col-md-12 p-1">
            <div class="profile-tab border p-2">
              <h3 class="">
                User : {{ $user->name }}
              </h3>

              <br>

              <p>
                <strong> Uploaded Books : </strong>
              </p>
              <hr>

              @include('frontend.pages.books.partials.list')
              <div class="books-pagination mt-5">
                    {{ $books->links() }}
              </div>

            </div>
          </div>

      </div>
    </div>
  </div>

</div>

@endsection