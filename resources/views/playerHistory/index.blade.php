@extends('admin.app')
@section('app')
<div class="card">
    <div class="card-body">
        <p>Player History</p>
        {{-- Search Form --}}
        <div class="form mt-3">
            <form action="" method="GET">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <label for="">Distributor <small>*</small></label>
                        <select class="form-control" name="distributor_id">
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
                        <select class="form-control" name="id">
                            <option value="">Select</option>
                            @foreach($gamename as $key => $game)
                                <option value="{{ $key }}" {{ request('id') == $key ? 'selected' : '' }}>
                                    {{ $game }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <label>From Date <small class="text-muted">*</small></label>
                        <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                    </div>
                    <div class="col-sm-6">
                        <label for="">To Date <small>*</small></label>
                        <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
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
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Total Bet</th>
                        <th>Total Win</th>
                        <th>Total Loss</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($playerHistories as $history)
                        <tr>
                            <td>{{ $history['user_id'] }}</td>
                            <td>{{ $history['player_name'] }}</td>
                            <td>{{ $history['total_bet'] }}</td>
                            <td>{{ $history['total_win'] }}</td>
                            <td>{{ $history['total_loss'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
