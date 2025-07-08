<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;
use App\Models\CustomerField;
use App\Models\Transaction;
use App\Models\UserRecharge;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.customers.index', compact('customers'));
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        $customFields = CustomerField::where('customer_id', $id)->get();
        $transactions = Transaction::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        $recharges = UserRecharge::where('customer_id', $id)->orderBy('created_at', 'desc')->get();
        
        return view('admin.customers.show', compact('customer', 'customFields', 'transactions', 'recharges'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:customers,username',
            'password' => 'required|string|min:6',
            'fullname' => 'required|string',
            'email' => 'required|email|unique:customers,email',
            'phonenumber' => 'required|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'district' => 'nullable|string',
            'state' => 'nullable|string',
            'zip' => 'nullable|string',
            'account_type' => 'required|in:Business,Personal',
            'service_type' => 'required|in:Hotspot,PPPoE,Others',
        ]);

        $customer = Customer::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber,
            'address' => $request->address,
            'city' => $request->city,
            'district' => $request->district,
            'state' => $request->state,
            'zip' => $request->zip,
            'account_type' => $request->account_type,
            'service_type' => $request->service_type,
            'status' => 'Active',
            'created_by' => Session::get('admin_id', 0),
        ]);

        return redirect()->route('admin.customers.index')->with('success', 'Customer created successfully.');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        
        $request->validate([
            'username' => 'required|string|unique:customers,username,' . $id,
            'fullname' => 'required|string',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phonenumber' => 'required|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'district' => 'nullable|string',
            'state' => 'nullable|string',
            'zip' => 'nullable|string',
            'account_type' => 'required|in:Business,Personal',
            'service_type' => 'required|in:Hotspot,PPPoE,Others',
            'status' => 'required|in:Active,Banned,Disabled,Inactive,Limited,Suspended',
        ]);

        $updateData = $request->only([
            'username', 'fullname', 'email', 'phonenumber', 'address',
            'city', 'district', 'state', 'zip', 'account_type', 
            'service_type', 'status'
        ]);

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $customer->update($updateData);

        return redirect()->route('admin.customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully.');
    }

    public function profile()
    {
        $customerId = Session::get('customer_id');
        if (!$customerId) {
            return redirect()->route('login');
        }

        $customer = Customer::findOrFail($customerId);
        return view('customer.profile', compact('customer'));
    }

    public function updateProfile(Request $request)
    {
        $customerId = Session::get('customer_id');
        if (!$customerId) {
            return redirect()->route('login');
        }

        $customer = Customer::findOrFail($customerId);
        
        $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|email|unique:customers,email,' . $customerId,
            'phonenumber' => 'required|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'district' => 'nullable|string',
            'state' => 'nullable|string',
            'zip' => 'nullable|string',
        ]);

        $updateData = $request->only([
            'fullname', 'email', 'phonenumber', 'address',
            'city', 'district', 'state', 'zip'
        ]);

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $customer->update($updateData);

        return redirect()->route('customer.profile')->with('success', 'Profile updated successfully.');
    }
}

