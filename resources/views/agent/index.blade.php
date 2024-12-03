@extends('admin.app')
@section('app')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">Agent</h5>
            {{-- Create Model --}}
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                style="position:absolute; top:30px; right:50px;">
                Create
            </button>
            <form action="{{ route('agentStore') }}" method="post">
                <!-- Modal -->
                @csrf
                <div class="modal fade" id="exampleModalCenter" role="dialog" aria-labelledby="exampleModalCenterTitle"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="card-body">
                                    {{-- Section-2 --}}
                                    <h4 class="card-title">Create Agent</h4>
                                    <hr>
                                    <div class="form">
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <label>E-mail<small>*</small></label>
                                                <input type="email" class="form-control" name="email">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="">Password<small>*</small></label>
                                                <input type="number" name="password" class="form-control">
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
                                            <label>Type<small>*</small></label>
                                            <input type="text" name="type" class="form-control">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="">Revenue Percent<small>*</small></label>
                                            <input type="number" class="form-control" name="revenue" placeholder="0">
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
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->password }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->wallet }}</td>
                                <td>{{ $item->parent_id }}</td>
                                <td>{{ $item->revenue }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
