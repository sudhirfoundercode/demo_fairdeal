@extends('admin.app')
@section('app')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">Player</h5>
            {{-- Create Model --}}
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                style="position:absolute; top:30px; right:50px;">
                Create
            </button>
            <form action="{{ route('PlayerStore') }}" method="POST">
                @csrf
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" role="dialog" aria-labelledby="exampleModalCenterTitle"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="card-body">
                                    {{-- Section-2 --}}
                                    <h4 class="card-title">Create Player</h4>
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
                                            <label for="">Distributor<small>*</small></label>
                                            <select class="form-control" aria-label="Default select example">
                                                <option selected>ABIR</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                     <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name">
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
                                <th><b>#</b></th>
                                <th><b>Username</b></th>
                                <th><b>Name</b></th>
                                <th><b>Password</b></th>
                                <!--add-->
                                <th><b>Mobile</b></th>
                                <th><b>Email</b></th>
                                <!--end add-->
                                <!--<th><b>Game</b></th>-->
                                <th><b>Parent</b></th>
                                <th><b>Balance</b></th>
                                 <!--add-->
                                 <th><b>Revenue</b></th>
                                  <!--end add-->
                                <!--<th><b>Total Bet</b></th>-->
                                <!--<th><b>Total Won</b></th>-->
                                <!--<th><b>Casino Profit</b></th>-->
                                <!--<th><b>Ntp %</b></th>-->
                                <!--<th><b>Bank Status</b></th>-->
                                <th><b>Action</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->password }}</td>
                                    <!--add-->
                                    <td>{{ $item->mobile }}</td>
                                    <td>{{ $item->email }}</td>
                                    <!--end add-->
                                    <!--<td></td>-->
                                    <td>{{ $item->parent_id }}</td>
                                    <td>{{$item->wallet}}
						<div style="display: flex; gap: 10px;">
                          <div class="btn btn-info btn-sm" style="border-radius: 10px;">
                            <i class="fa fa-plus" data-toggle="modal" data-target="#exampleModalCenter{{$item->id}}" style="font-size:15px"></i>
                          </div>
                          <div class="btn btn-danger btn-sm" style="border-radius: 10px;">
                            <i class="fa fa-minus" data-toggle="modal" data-target="#subtractWalletModal{{$item->id}}" style="font-size:15px"></i>
                          </div>
                        </div>

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

					   </td>
					             <!--add-->
                                    <td>{{ $item->revenue }}</td>
                                    <!--end add-->
                                    <!--<td></td>-->
                                    <!--<td></td>-->
                                    <!--<td></td>-->
                                    <!--<td></td>-->
                                    <!--<td></td>-->
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

        </div>
    </div>
@endsection
