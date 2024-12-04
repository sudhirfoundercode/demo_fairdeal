@extends('admin.app')
@section('app')
    <div class="card">
        <div class="card-body">
            {{-- Title --}}
            <h5 class="card-title mb-4">Stokez</h5>
            {{-- Create Model --}}
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                style="position:absolute; top:30px; right:50px;">
                Create
            </button>
            <form action="{{ route('StokezStore') }}" method="POST">
                @csrf
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" role="dialog" aria-labelledby="exampleModalCenterTitle"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="card-body">
                                    {{-- Section-2 --}}
                                    <h4 class="card-title">Create Stokez</h4>
                                    <hr>
                                    <div class="form">
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <label>Email<small>*</small></label>
                                                <input type="email" class="form-control" name="email">

                                            </div>
                                            <div class="col-sm-6">
                                                <label for="">Password<small>*</small></label>
                                                <input type="number" class="form-control" name="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="">Type</label>
                                            <select class="form-control" aria-label="Default select example">
                                                <option selected="">TN</option>
                                                <option value="1">RV</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label>Revenue Percent<small>*</small></label>
                                            <input type="text" class="form-control" name="revenue" placeholder="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="">Parent<small>*</small></label>
                                            <select class="form-control" aria-label="Default select example">
                                                <option selected="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <hr>
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>

                        <tr>
                            <th><b>id</b></th>
                            <th><b>Username</b></th>
                            <th><b>Password</b></th>
                            <th><b>Name</b></th>
                            <th><b>Type</b></th>
                            <th><b>Balance</b></th>
                            <th><b>Parent</b></th>
                            <th><b>Revenue</b></th>
                            <th><b>Actions</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->password }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->wallet }}</td>
                                <td>{{ $item->parent_id }}</td>
                                <td>{{ $item->revenue }}</td>
                                <td>
                            <!--<i  class="fa-duotone fa-regular fa-pen-to-square h3"></i>-->
                            <i class="fa fa-edit h3" data-toggle="modal" style="color:blue" data-target="#exampleModalCenterupdate1{{$item->id}}" style="font-size:30px"></i>
                            <i class="fa-duotone fa-solid fa-circle-up h3" style="color:green" data-toggle="modal" data-target="#exampleModalCenter{{$item->id}}"></i>
                            <i class="fa-duotone fa-solid fa-circle-down h3" style="color:red" data-toggle="modal" data-target="#subtractWalletModal{{$item->id}}"></i>
                            <!--<i class="fa-duotone fa-solid fa-unlock h3" style="color:green;"></i>-->
                             <!-- Block/Unblock Icon -->
        @if ($item->status == 0)
            <i class="fa-duotone fa-solid fa-lock h3" style="color:red;"></i>
            <span>Blocked</span>
            <!-- Link to Unblock -->
            <a href="{{ route('SuperStokez.BlockUnblock', $item->id) }}" class="btn btn-success btn-sm">Unblock</a>
        @else
            <i class="fa-duotone fa-solid fa-unlock h3" style="color:green;"></i>
            <span>Unblocked</span>
            <!-- Link to Block -->
            <a href="{{ route('SuperStokez.BlockUnblock', $item->id) }}" class="btn btn-danger btn-sm">Block</a>
        @endif
                        </td>
                        <!--edit super stokez-->
                        <div class="modal fade" id="exampleModalCenterupdate1{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Edit Super Stokez</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{route('SuperStokez.update',$item->id)}}" method="post" enctype="multipart/form-data">
                              @csrf
                            <div class="modal-body">
                              <div class="container-fluid">
                                <div class="row">
                                  <div class="form-group col-md-6">
                                    <label for="accumulated_amount">Name</label>
                                    <input type="text" class="form-control" id="accumulated_amount" name="name" value="{{$item->name}}" placeholder="Enter name">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                  </div>
                                  
                                  <div class="form-group col-md-6">
                                    <label for="amount">Email</label>
                                    <input type="text" class="form-control" id="amount" name="email" value="{{$item->email}}" placeholder="Enter name">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                  </div>
                            
                          </div>
                          <div class="row">
                                  <div class="form-group col-md-6">
                                    <label for="accumulated_amount">password</label>
                                    <input type="text" class="form-control" id="accumulated_amount" name="password" value="{{$item->password}}" placeholder="Enter name">
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                  </div>
                                  
                                  <div class="form-group col-md-6">
                                    <label for="amount">Revenue</label>
                                    <input type="text" class="form-control" id="amount" name="revenue" value="{{$item->revenue}}" placeholder="Enter name">
                                    @error('revenue')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                  </div>
                            
                          </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </form>
                         </div>
                      </div>
                      </div>
                        </div>
                        </div>
                      <!--end edit super stokez-->
                      
                      <!--add wallet-->
                      <div class="modal fade" id="exampleModalCenter{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Wallet</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('wallet.store',$item->id)}}" method="post" enctype="multipart/form-data">
          @csrf
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="wallet">Wallet Amount</label>
                <input type="text" class="form-control" id="wallet" name="wallet" value="" placeholder="Enter Amount">
                @error('wallet')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              
              
            </div>
            
           
			</div>
			</div>
       
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
			 
        </div>
			</form>
      </div>
    </div>
	</div>
						  
						  <!-- Subtract Wallet Modal -->
                          <div class="modal fade" id="subtractWalletModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="subtractWalletModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="subtractWalletModalTitle">Subtract Wallet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('wallet.subtract', $item->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="form-group col-md-12">
                <label for="wallet">Wallet Amount</label>
                <input type="text" class="form-control" id="wallet" name="wallet" value="" placeholder="Enter Amount">
                @error('wallet')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--end substract wallet-->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
