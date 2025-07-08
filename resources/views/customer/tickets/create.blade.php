@extends('layouts.app')

@section('title', 'Open Ticket')
@section('page-title', 'Open Ticket')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('customer.tickets.index') }}">Tickets</a></li>
    <li class="breadcrumb-item active">Open Ticket</li>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('customer.tickets.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Subject</label>
                <input type="text" name="subject" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea name="message" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
