<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;
use App\Models\Plan;
use App\Models\Transaction;
use App\Models\Router;
use App\Models\UserRecharge;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function customerDashboard()
    {
        $customerId = Session::get('customer_id');
        if (!$customerId) {
            return redirect()->route('login');
        }

        $customer = Customer::find($customerId);
        if (!$customer) {
            return redirect()->route('login');
        }

        // Get active plan
        $activePlan = UserRecharge::where('customer_id', $customerId)
            ->where('status', 'on')
            ->where('expiration', '>=', now()->toDateString())
            ->first();

        // Get recent transactions
        $recentTransactions = Transaction::where('user_id', $customerId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $openTickets = Ticket::where('customer_id', $customerId)
            ->where('status', 'open')
            ->count();

        return view('customer.dashboard', compact('customer', 'activePlan', 'recentTransactions', 'openTickets'));
    }

    public function adminDashboard()
    {
        $adminId = Session::get('admin_id');
        if (!$adminId) {
            return redirect()->route('login');
        }

        // Dashboard statistics
        $totalCustomers = Customer::count();
        $activeCustomers = Customer::where('status', 'Active')->count();
        $totalPlans = Plan::where('enabled', true)->count();
        $totalRouters = Router::where('enabled', true)->count();
        
        // Recent transactions
        $recentTransactions = Transaction::orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Monthly revenue
        $monthlyRevenue = Transaction::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('price');

        $openTickets = Ticket::where('status', 'open')->count();
        $inProgressTickets = Ticket::where('status', 'in_progress')->count();
        $pendingTickets = Ticket::where('status', 'pending')->count();
        $closedTickets = Ticket::where('status', 'closed')->count();

        return view('admin.dashboard', compact(
            'totalCustomers',
            'activeCustomers',
            'totalPlans',
            'totalRouters',
            'recentTransactions',
            'monthlyRevenue',
            'openTickets',
            'inProgressTickets',
            'pendingTickets',
            'closedTickets'
        ));
    }
}

