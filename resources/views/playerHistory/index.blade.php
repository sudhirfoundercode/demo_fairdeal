@extends('admin.app')
@section('app')
<div class="card">
    <div class="card-body">
        <p>Player History</p>
        {{-- Search Form --}}
        <div class="form mt-3">
            <form action="{{ route('playerHistory.index') }}" method="POST">
                @csrf
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <label for="">Distributor <small>*</small></label>
                        <select class="form-control" name="distributor_id" required>
                            <option value="">Select</option>
                            @foreach($distributor as $item)
                                <option value="{{ $item->id }}" {{ request('distributor_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Game Name <small>*</small></label>
                        <select class="form-control" name="id" required>
                            <option value="">Select</option>
                                <option value="1">Green 36 Game</option>
                                <option value="2">Blue 36 Game</option>
                                <option value="3">Fun Target Game</option>
                                  
                               
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <label>From Date <small class="text-muted">*</small></label>
                        <input type="date" name="from_date" class="form-control" value="">
                    </div>
                    <div class="col-sm-6">
                        <label for="">To Date <small>*</small></label>
                        <input type="date" name="to_date" class="form-control" value="">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
        

        {{-- Table for Details --}}
        <div class="table-responsive mt-4">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Player</th>
                        <th>Total Bet</th>
                        <th>Total Win</th>
                        <th>Total Loss</th>
                        <th>Game Name</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($blue_36_bets) && $blue_36_bets->isNotEmpty())
                      @foreach($blue_36_bets as $item)
                      <tr>
                        <td>{{$item->name}}</td>
                         <td>{{$item->total_bet}}</td>
                          <td>{{$item->total_win}}</td>
                           <td>{{$item->total_loss}}</td>
                            <td>{{$item->description}}</td>
                            </tr>
                      @endforeach
                    @endif
                    
                    
                    @if(isset($green_36_bets) && $green_36_bets->isNotEmpty())
                      @foreach($green_36_bets as $item)
                      <tr>
                        <td>{{$item->name}}</td>
                         <td>{{$item->total_bet}}</td>
                          <td>{{$item->total_win}}</td>
                           <td>{{$item->total_loss}}</td>
                            <td>{{$item->description}}</td>
                            </tr>
                      @endforeach
                    @endif
                    
                    
                    
                    @if(isset($fun_bets) && $fun_bets->isNotEmpty())
                      @foreach($fun_bets as $item)
                      <tr>
                        <td>{{$item->name}}</td>
                         <td>{{$item->total_bet}}</td>
                          <td>{{$item->total_win}}</td>
                           <td>{{$item->total_loss}}</td>
                            <td>{{$item->description}}</td>
                            </tr>
                      @endforeach
                    @endif
                    

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
