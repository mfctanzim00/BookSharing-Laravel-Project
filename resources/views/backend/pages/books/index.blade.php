@extends('backend.layouts.app')

@section('admin-content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manage Books</h1>
                        <a href="{{ route('admin.books.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i
                                class="fas fa-plus-circle fa-sm text-white-50"></i> Add Book </a>
                    </div>
                    @include('backend.layouts.partials.messages')

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Book Lists</h6>
                                </div>
                                <div class="card-body">
                                   <table class="table" id="dataTable">
                                       <thead>
                                           <tr>
                                               <th> Sl </th>
                                               <th> Name </th>
                                               <th> Category </th>
                                               <th> Publisher </th>
                                               <th> Statistics </th>
                                               <th> Status </th>
                                               <th> Manage </th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                           @foreach($books as $book)
                                           <tr>
                                               <td> {{ $loop->iteration }} </td>
                                               <td> <a href="{{ route('books.show', $book->slug) }}" target="_blank">    
                                                {{ $book->title }}  </a> </td>
                                              
                                               <td>
                                                {{-- @if(empty($book->category->name))
                                      -//-
                                                @else 
                                                  {{ $book->category->name }}
                                                @endif --}}
                                                  {{ $book->category->name }}
                                               </td>
                                               <td>
                                                {{-- @if(empty($book->publisher->name))
                                                  -//-
                                                @else 
                                                  {{ $book->publisher->name }}
                                                @endif --}}
                                                 {{ $book->publisher->name }}
                                               </td> 
                                               <td>
                                                 <i class="fa fa-eye"></i> {{ $book->total_view }}    
                                                 <br>
                                                 <i class="fa fa-search"></i> {{ $book->total_search }}
                                               </td>
                                               <td>
                                                   @if($book->is_approved)
                                                      <span class="badge badge-success">
                                                         <i class="fa fa-check"></i> Approved
                                                      </span>
                                                   @else
                                                      <span class="badge badge-danger">
                                                         <i class="fa fa-times"></i> Not Approved
                                                      </span>
                                                      <form action="{{ route('admin.books.approve', $book->id) }}" method="post">
                                                           @csrf
                                                           <button type="submit" class="badge badge-success">
                                                             <i class="fa fa-check"></i>Approve Now
                                                           </button>
                                                         </form>
                                                   @endif

                                                   {{-- @if(isset($approved))
                                                      @if(!$approved)
                                                         <form action="{{ route('admin.books.approve', $book->id) }}">
                                                           @csrf
                                                           <button type="submit" class="btn btn-success">
                                                             <i class="fa fa-check"></i>Approve Now
                                                           </button>
                                                         </form>
                                                      @endif
                                                   @endif --}}
                                               </td>
                                               <td>
                                                   <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-success"><i class="fa fa-edit"></i> </a>

                                                   <a href="#deleteModal{{ $book->id }}" class="btn btn-danger" data-toggle="modal"><i class="fa fa-trash"></i>  </a>
                                               </td>
                                           </tr>


                               <!-- Delete Modal -->
                               <div class="modal fade" id="deleteModal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure to Delete ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="{{ route('admin.books.delete', $book->id) }}" method="post">
                                        @csrf
                                        <div>
                                            {{ $book->name }} will be deleted!!
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary">Ok, Confirm</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>

                                    </div>
                                  </div>
                                 </div>
                                </div>
                               <!-- Delete Modal -->

                                           @endforeach
                                       </tbody>
                                   </table>
                                </div>
                            </div>

                        </div>                        
                    </div>

@endsection

