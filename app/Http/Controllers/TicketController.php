<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.tickets.index', compact('tickets'));
    }

    public function customerIndex()
    {
        $customerId = Session::get('customer_id');
        if (!$customerId) {
            return redirect()->route('login');
        }

        $tickets = Ticket::where('customer_id', $customerId)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('customer.tickets.index', compact('tickets'));
    }

    public function create()
    {
        $customerId = Session::get('customer_id');
        if (!$customerId) {
            return redirect()->route('login');
        }

        return view('customer.tickets.create');
    }

    public function store(Request $request)
    {
        $customerId = Session::get('customer_id');
        if (!$customerId) {
            return redirect()->route('login');
        }

        $request->validate([
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        Ticket::create([
            'customer_id' => $customerId,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'open',
        ]);

        return redirect()->route('customer.tickets.index')
            ->with('success', 'Ticket created successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,pending,closed',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->status = $request->status;
        $ticket->save();

        return back()->with('success', 'Ticket status updated.');
    }
}
