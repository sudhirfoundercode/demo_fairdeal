@extends('admin.app')
@section('app')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Andar Bahar Bet Results Table</h4>
                    </div>
                    <form action="{{ route('andar_bahar.betresult') }}" method="post">
                        @csrf <!-- Ensure you include CSRF token if you're using POST -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th><strong>ID</strong></th>
                                        <th><strong>Number</strong></th>
                                        <th><strong>Period Number</strong></th>
                                        <th><strong>Game ID</strong></th>
                                        <th><strong>AnderBhar Cards</strong></th>
                                        <th><strong>Random Cards</strong></th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($records as $record)
                                        <tr>
                                            <td>{{ $record->id }}</td>
                                            <td>{{ $record->number }}</td>
                                            <td>{{ $record->period_no }}</td>
                                            <td>{{ $record->game_id }}</td>
                                            <td>{{ $record->andar_bahar_card }}</td>
                                            <td>{{ $record->random_card }}</td>
                                            <td>
                                                @if ($record->status == 0)
                                                    Pending
                                                @elseif ($record->status == 1)
                                                    Win
                                                @elseif ($record->status == 2)
                                                    Loss
                                                @endif
                                            </td>
                                            <td>{{ $record->created_at }}</td>
                                            <td>{{ $record->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination Code --}}
                        @if ($records->hasPages())
                            <nav>
                                <style>
                                    .pagination {
                                        display: flex;
                                        justify-content: center;
                                        list-style: none;
                                        padding: 0;
                                    }
                                    .pagination .page-item {
                                        margin: 0 5px;
                                    }
                                    .pagination .page-item .page-link {
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        width: 40px;
                                        height: 40px;
                                        border-radius: 50%;
                                        border: 1px solid #ddd;
                                        text-decoration: none;
                                        color: #333;
                                        font-weight: bold;
                                        transition: all 0.3s ease;
                                    }
                                    .pagination .page-item .page-link:hover {
                                        background-color: #e0e0e0;
                                        border-color: #ddd;
                                    }
                                    .pagination .page-item.active .page-link {
                                        background-color: #6f42c1;
                                        color: white;
                                        border-color: #6f42c1;
                                    }
                                    .pagination .page-item.disabled .page-link {
                                        color: #6c757d;
                                        pointer-events: none;
                                        background-color: #f5f5f5;
                                        border-color: #ddd;
                                    }
                                </style>
                                
                                <ul class="pagination">
                                    {{-- Previous Page Link --}}
                                    @if ($records->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">&lt;</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $records->previousPageUrl() }}" rel="prev">&lt;</a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($records->links()->elements as $element)
                                        {{-- "Three Dots" Separator --}}
                                        @if (is_string($element))
                                            <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                                        @endif

                                        {{-- Array Of Links --}}
                                        @if (is_array($element))
                                            @foreach ($element as $page => $url)
                                                @if ($page == $records->currentPage() || $page == 1 || $page == $records->lastPage() || ($page >= $records->currentPage() - 2 && $page <= $records->currentPage() + 2))
                                                    @if ($page == $records->currentPage())
                                                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                                    @else
                                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                                    @endif
                                                @elseif ($page == $records->currentPage() - 3 || $page == $records->currentPage() + 3)
                                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($records->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $records->nextPageUrl() }}" rel="next">&gt;</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link">&gt;</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
