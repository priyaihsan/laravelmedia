<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    public function index($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('payment.index' , compact('order'));
    }

    public function store(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        $request->validate([
            'payment_method' => 'required',
            'payer_information' => 'required|file',
            'payment_amount' => 'required|numeric',
        ]);

        // dd($request->toArray());

        if ($request->hasFile('payer_information')) {
            $file = $request->file('payer_information');
            $path = $file->store('payment-images');
        } else {
            $path = null;
        }

        $payment = Payment::create(
            [
                'order_id' => $order->id,
                'payment_method' => $request->payment_method,
                'payment_amount' => $request->payment_amount,
                'payer_information' => $path,
            ]
        );

        $balance = $order->total_price - $request->payment_amount;

        if($balance == 0){
            $order->update(['status' => 'checking']);
        }else{
            $order->update(['status' => 'payment']);
            $order->total_price = $balance;
        }


        return redirect()->route('profile.checkout')->with('success', 'Payment successfully!');
    }
}
