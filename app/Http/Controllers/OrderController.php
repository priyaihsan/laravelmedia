<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index($name)
    {
        $orderDetails = OrderDetail::with('order', 'commision')
            ->with('order', function ($query) {
                $query->where('customer_id', auth()->user()->id);
                $query->where('status', 'pending');
            })
            ->get();

        $order = Order::where('customer_id', auth()->user()->id)
            ->where('status', 'pending')
            ->first();
        // $orderDetails = OrderDetail::where('order_id', $order->id)
        //     ->with('commision')
        //     ->get();
        $count = 1;

        // dd($orderDetails->toArray());

        return view('order.index', compact('orderDetails', 'count', 'order', 'name'));
    }

    public function orderCheckout($name)
    {
        $order = Order::where('customer_id', auth()->user()->id)->first();

        if (!empty($order)) {
            $order->update([
                'status' => 'payment'
            ]);
        }
        return redirect()->route('order.index', $name)->with('success', 'checkout successfully!');
    }

    public function orderPayment()
    {
        $payments = Payment::with('order')
            ->whereHas('order', function ($query) {
                $query->where('artist_id', auth()->user()->id);
            })
            ->get();

        $orders = Order::where('artist_id', auth()->user()->id)
        ->with('customer')
        ->get();

        $orderDetails = OrderDetail::with('commision')
            ->with('order', function ($query) {
                $query->where('artist_id', auth()->user()->id);
            })
            ->get();

        // dd($orderDetails->toArray());
        // dd($payments->toArray());

        return view('order.orderPayment', compact('payments', 'orderDetails', 'orders'));
    }
}
