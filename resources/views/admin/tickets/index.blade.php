@extends('layouts.app')

@section('title', 'Support Tickets')
@section('page-title', 'Support Tickets')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Tickets</li>
@endsection

@section('content')
<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->customer->username ?? 'N/A' }}</td>
                        <td>{{ $ticket->subject }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $ticket->status)) }}</td>
                        <td>{{ $ticket->created_at->format('M d, Y') }}</td>
                        <td>
                            <form action="{{ route('admin.tickets.updateStatus', $ticket->id) }}" method="POST" class="d-inline">
                                @csrf
                                <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                    <option value="open" {{ $ticket->status=='open' ? 'selected' : '' }}>Open</option>
                                    <option value="in_progress" {{ $ticket->status=='in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="pending" {{ $ticket->status=='pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="closed" {{ $ticket->status=='closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No tickets found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $tickets->links() }}
    </div>
</div>
@endsection
