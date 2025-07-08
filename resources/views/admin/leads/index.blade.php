@extends('layouts.app')

@section('page-title', 'Leads')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Leads</h3>
        <a href="{{ route('admin.leads.create') }}" class="btn btn-primary btn-sm">Add Lead</a>
    </div>
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leads as $lead)
                    <tr>
                        <td>{{ $lead->name }}</td>
                        <td>{{ $lead->email }}</td>
                        <td>{{ $lead->phone }}</td>
                        <td>{{ $lead->status }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.leads.edit', $lead->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                            <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this lead?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($leads->hasPages())
        <div class="card-footer">
            {{ $leads->links() }}
        </div>
    @endif
</div>
@endsection
