@extends('backend.layouts.app')

@section('admin-content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manage Publishers</h1>
                        <a href="#addModal" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-toggle="modal"><i
                                class="fas fa-plus-circle fa-sm text-white-50"></i> Add Publisher </a>
                    </div>
                    @include('backend.layouts.partials.messages')

                    <!-- Add Modal -->
                    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Publisher</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                         </div>
                       <div class="modal-body">
                        <form action="{{ route('admin.publishers.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Publisher Name</label>
                                    <br>
                                    <input type="text" class="form-control" name="name" placeholder="Publisher Name">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Publisher Link</label>
                                    <br>
                                    <input type="text" class="form-control" name="link" placeholder="Publisher Link">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Publisher Address</label>
                                    <br>
                                    <input type="text" class="form-control" name="address" placeholder="Publisher Address" >
                                </div>
                                <div class="col-md-6">
                                    <label for="">Publisher Outlet</label>
                                    <br>
                                    <input type="text" class="form-control" name="outlet" placeholder="Publisher Outlet" >
                                </div>
                                <div class="col-12">
                                    <label for="">Publisher Details</label>
                                    <br>
                                    <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Publisher Description"></textarea>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                        
                         </div>
                       </div>
                     </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Publishers Lists</h6>
                                </div>
                                <div class="card-body">
                                   <table class="table" id="dataTable">
                                       <thead>
                                           <tr>
                                               <th> Sl </th>
                                               <th> Name </th>
                                               <th> Link </th>
                                               <th> Address </th>
                                               <th> Outlet </th>
                                               <th> Manage </th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                           @foreach($publishers as $publisher)
                                           <tr>
                                               <td> {{ $loop->iteration }} </td>
                                               <td> {{ $publisher->name }} </td>
                                               <td> {{ $publisher->link }} </td>
                                               <td> {{ $publisher->address }} </td>
                                               <td> {{ $publisher->outlet }} </td>
                                               <td>
                                                   <a href="#editModal{{ $publisher->id }}" class="btn btn-success" data-toggle="modal"><i class="fa fa-edit"></i>  </a>

                                                   <a href="#deleteModal{{ $publisher->id }}" class="btn btn-danger" data-toggle="modal"><i class="fa fa-trash"></i>  </a>
                                               </td>
                                           </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $publisher->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Publisher</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="{{ route('admin.publishers.update', $publisher->id) }}" method="post">
                                        @csrf
                                        <div class="row">
                                          <div class="col-md-6">
                                            <label for="">Publisher Name</label>
                                            <br>
                                            <input type="text" class="form-control" name="name" placeholder="Publisher Name" value="{{$publisher->name}}">
                                          </div>
                                          <div class="col-md-6">
                                            <label for="">Publisher Link</label>
                                            <br>
                                            <input type="text" class="form-control" name="link" placeholder="Publisher Link" value="{{$publisher->link}}">
                                          </div>
                                          <div class="col-md-6">
                                            <label for="">Publisher Address</label>
                                            <br>
                                            <input type="text" class="form-control" name="address" placeholder="Publisher Address" value="{{$publisher->address}}">
                                          </div>
                                          <div class="col-md-6">
                                            <label for="">Publisher Outlet</label>
                                            <br>
                                            <input type="text" class="form-control" name="outlet" placeholder="Publisher Outlet" value="{{$publisher->outlet}}">
                                          </div>
                                          <div class="col-12">
                                            <label for="">Publisher Details</label>
                                            <br>
                                            <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Publisher Description">{!! $publisher->description !!}</textarea>
                                          </div>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>

                                    </div>
                                  </div>
                                 </div>
                                </div>
                               <!-- Edit Modal -->


                               <!-- Delete Modal -->
                               <div class="modal fade" id="deleteModal{{ $publisher->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure to Delete ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="{{ route('admin.publishers.delete', $publisher->id) }}" method="post">
                                        @csrf
                                        <div>
                                            {{ $publisher->name }} will be deleted!!
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

