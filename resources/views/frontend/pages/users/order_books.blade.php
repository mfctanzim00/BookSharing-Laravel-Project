@extends('frontend.layouts.app')
@section('content')

<div class="main-content">

  <div class="login-area page-area">
    <div class="container">
      <div class="row">
          <div class="col-md-8 p-1">
            <div class="profile-tab border p-2">
              <h3 class="">
                My Ordered Books
              </h3>
              <hr>
              <div class="table-responsive">

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>SL</th>
                      <th>Book</th>
                      <th>Owner</th>
                      <th>Message</th>
                      <th>Action</th>
                    </tr>
                    @foreach($book_orders as $br)
                 
                    <tr>
                      <td>{{ $loop->index+1 }}</td>
                      <td><a href="{{ route('books.show', $br->book->slug) }}">{{ $br->book->title }}</a></td>
                      <td>
                        {{ $br->owner->name }}
                        <br>
                        {{ $br->owner->phone_no }}
                      </td>
                      <td> {{ $br->owner_message }} </td>
                      <td>
                        @if($br->status == 1)
                           Request Sent
                        @elseif($br->status == 2)
                           Owner Approved
                        @elseif($br->status == 3)
                           Owner Rejected
                        @elseif($br->status == 4)
                           Confirmed
                        @elseif($br->status == 5)
                           Rejected
                        @endif

                        @if($br->status == 2)
                            <form action="{{ route('books.order.approve', $br->id) }}" method="post">
                              @csrf
                               <button type="submit" class="btn btn-success">Approve</button>
                             </form>

                             <form action="{{ route('books.order.reject', $br->id) }}" method="post" class="mt-1">
                              @csrf
                                <button type="submit" class="btn btn-danger">Reject</button>
                               </form>
                
                        @elseif($br->status == 3)
                            <form action="{{ route('books.request.reject', $br->id) }}" method="post" class="mt-1">
                              @csrf
                                <button type="submit" class="btn btn-danger">Reject</button>
                               </form>

                        @elseif($br->status == 3)
                            <form action="{{ route('books.request.approve', $br->id) }}" method="post">
                              @csrf
                               <button type="submit" class="btn btn-success">Approve</button>
                             </form>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </thead>
                </table>
                {{ $book_orders->links() }}
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