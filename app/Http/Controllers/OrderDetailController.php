<?php

namespace App\Http\Controllers;

use App\Models\Commision;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    //
    public function addToCard(Request $request, $name)
    {

        $request->validate([
            'price_per_item' => 'required|numeric',
            'id' => 'required|numeric',
        ]);

        // dd($request->toArray());

        $total_price = 1 * $request->price_per_item;

        // dd($total_price);

        $artist = User::where('name',$name)->first();

        $order = Order::where('customer_id', auth()->user()->id)
            ->where('status', 'pending')
            ->first();

        if (empty($order)) {
            $order = Order::create([
                'customer_id' => auth()->user()->id,
                'artist_id'=> $artist->id,
                'total_price' => $total_price,
            ]);

            $order = Order::where('customer_id', auth()->user()->id)
                ->where('status', 'pending')
                ->first();
            // $order->update();
        } else {
            $total_price = $order->total_price + $total_price;
            $order->update([
                'total_price' => $total_price,
            ]);
        }

        $orderDetail = OrderDetail::where('order_id', $order->id)
            ->where('commision_id', $request->id)
            ->first();

        if (empty($orderDetail)) {
            $orderDetail = OrderDetail::create([
                'order_id' => $order->id,
                'commision_id' => $request->id,
                'quantity' => 1,
                'price_per_item' => 1 * $request->price_per_item,
            ]);
        } else {

            $currentQuantity = $orderDetail->quantity;
            $currentPrice = $orderDetail->price_per_item;

            $orderDetail->update([
                'quantity' => $currentQuantity + 1,
                'price_per_item' => $currentPrice + (1 * $request->price_per_item),
            ]);
        }
        return redirect()->route('profile.layanan', $name)->with('success', 'Post created successfully!');
    }

    public function increment($orderDetailId)
    {
        $orderDetail = OrderDetail::where('id', $orderDetailId)
            ->with('commision')
            ->first();

        // dd($orderDetail->quantity);
        $newQuantity = $orderDetail->quantity + 1;
        $newPrice = $newQuantity * $orderDetail->commision->price;

        // dd($newPrice, $newQuantity);
        $orderDetail->update([
            'quantity' => $newQuantity,
            'price_per_item' => $newPrice,
        ]);

        $orderDetails = OrderDetail::where('order_id', $orderDetail->order_id)->get();
        $newTotalPrice = 0;

        foreach ($orderDetails as $orderDetail) {
            $newTotalPrice += $orderDetail->price_per_item;
        }
        // dd($newTotalPrice);

        $order = Order::where('id', $orderDetail->order_id)->first();
        // dd($order->toArray());
        $order->update([
            'total_price' => $newTotalPrice,
        ]);

        return redirect()->route('order.index', auth()->user()->name)->with('success', 'increment successfully!');
    }

    public function decrement($orderDetailId)
    {
        $orderDetail = OrderDetail::where('id', $orderDetailId)
            ->with('commision')
            ->first();

        // dd($orderDetail->quantity);
        $newQuantity = $orderDetail->quantity - 1;
        $newPrice = $newQuantity * $orderDetail->commision->price;

        // dd($newPrice, $newQuantity);
        $orderDetail->update([
            'quantity' => $newQuantity,
            'price_per_item' => $newPrice,
        ]);

        $orderDetails = OrderDetail::where('order_id', $orderDetail->order_id)->get();
        $newTotalPrice = 0;

        foreach ($orderDetails as $orderDetail) {
            $newTotalPrice += $orderDetail->price_per_item;
        }
        // dd($newTotalPrice);

        $order = Order::where('id', $orderDetail->order_id)->first();
        // dd($order->toArray());
        $order->update([
            'total_price' => $newTotalPrice,
        ]);

        return redirect()->route('order.index', auth()->user()->name)->with('success', 'decrement successfully!');
    }

    public function destroy($orderDetailId)
    {
        // menghapus order detail
        $orderDetail = OrderDetail::where('id', $orderDetailId)
            ->first();
        $orderDetail->delete();

        // update total price kalau ada, jika tidak hapus order
        $newTotalPrice = 0;
        $order = Order::where('customer_id', auth()->user()->id)->first();
        $orderDetails = OrderDetail::where('order_id', $order->id)->get();

        if (empty($orderDetails)) {
            $order->delete();
        } else {
            foreach ($orderDetails as $orderDetail) {
                $newTotalPrice += $orderDetail->price_per_item;
            }
            // dd($newTotalPrice);
            $order->update([
                'total_price' => $newTotalPrice,
            ]);
        }


        return redirect()->route('order.index', auth()->user()->name)->with('success', 'delete successfully!');
    }
}
