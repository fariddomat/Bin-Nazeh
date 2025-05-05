<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $orders = \App\Models\Order::all();
        return view('dashboard.orders.index', compact('orders'));
    }

    public function create()
    {
                $services = \App\Models\Service::all();

        return view('dashboard.orders.create', compact([],'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'project_type' => 'required|string|max:255',
            'message' => 'nullable|string',
            'status' => 'required|in:pending,processed,completed'
        ]);
        
        $order = \App\Models\Order::create($validated);
        
        return redirect()->route('dashboard.orders.index')->with('success', 'Order created successfully.');
    }

    public function show($id)
    {
        $order = \App\Models\Order::findOrFail($id);
                $services = \App\Models\Service::all();

        return view('dashboard.orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = \App\Models\Order::findOrFail($id);
                $services = \App\Models\Service::all();

        return view('dashboard.orders.edit', compact('order', 'services'));
    }

    public function update(Request $request, $id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'project_type' => 'required|string|max:255',
            'message' => 'nullable|string',
            'status' => 'required|in:pending,processed,completed'
        ]);
        
        $order->update($validated);
        
        return redirect()->route('dashboard.orders.index')->with('success', 'Order updated successfully.');
    }

        public function destroy($id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $order->delete();
        return redirect()->route('dashboard.orders.index')->with('success', 'Order deleted successfully.');
    }
    public function restore($id)
    {
        $order = \App\Models\Order::withTrashed()->findOrFail($id);
        $order->restore();
        return redirect()->route('dashboard.orders.index')->with('success', 'Order restored successfully.');
    }
}