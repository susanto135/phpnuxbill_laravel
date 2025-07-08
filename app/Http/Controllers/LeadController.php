<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.leads.index', compact('leads'));
    }

    public function create()
    {
        return view('admin.leads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:128',
            'email' => 'nullable|email|max:128',
            'phone' => 'nullable|string|max:32',
            'status' => 'required|in:New,Contacted,Qualified,Lost,Customer',
            'notes' => 'nullable|string',
        ]);

        Lead::create($request->only(['name', 'email', 'phone', 'status', 'notes']));

        return redirect()->route('admin.leads.index')->with('success', 'Lead created successfully.');
    }

    public function edit($id)
    {
        $lead = Lead::findOrFail($id);
        return view('admin.leads.edit', compact('lead'));
    }

    public function update(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:128',
            'email' => 'nullable|email|max:128',
            'phone' => 'nullable|string|max:32',
            'status' => 'required|in:New,Contacted,Qualified,Lost,Customer',
            'notes' => 'nullable|string',
        ]);

        $lead->update($request->only(['name', 'email', 'phone', 'status', 'notes']));

        return redirect()->route('admin.leads.index')->with('success', 'Lead updated successfully.');
    }

    public function destroy($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        return redirect()->route('admin.leads.index')->with('success', 'Lead deleted successfully.');
    }
}
