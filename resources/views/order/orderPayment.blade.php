<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orderan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach ($orders as $order)
                        <div
                            class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center text-left gap-2">
                                        <img class="rounded-full w-10 h-10"
                                            src="{{ $order->customer->profile_picture }}" alt="">
                                        <div class="flex flex-col">
                                            <h5
                                                class=" text-base font-bold tracking-tight text-gray-900 dark:text-white">
                                                {{ $order->customer->name }}</h5>
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-300">
                                                {{ $order->customer->email }}</p>
                                        </div>
                                    </div>
                                    @if ($order->status == 'payment')
                                        <span
                                            class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">menunggu
                                            proses pembayaran</span>
                                    @endif
                                    @if ($order->status == 'checking')
                                        <span
                                            class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">sudah
                                            di bayar</span>
                                    @endif
                                </div>
                                <div>
                                    @if ($order->status == 'checking')
                                        @foreach ($payments as $payment)
                                            @if ($payment->order_id == $order->id)
                                                <div class="mt-2">
                                                    {{-- blue button edit profile --}}
                                                    <a href=""
                                                        class="flex items-center justify-center w-full px-4 py-2  text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                        Lihat Bukti Pembayaran
                                                    </a>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                            <p class="text-lg font-medium mt-5">List Pesanan</p>
                            <table class="w-full">
                                @foreach ($orderDetails as $orderDetail)
                                    @if ($orderDetail->order_id == $order->id)
                                        <tr class="border-b border-gray-400">
                                            <th class="px-2 py-1 text-left">{{ $orderDetail->commision->title }}
                                            </th>
                                            <td class="px-2 py-1">{{ $orderDetail->quantity }}</td>
                                            <td class="px-2 py-1">.</td>
                                            <td class="px-2 py-1"><span>Rp.
                                                </span>{{ $orderDetail->commision->price }}</td>
                                            <td class="px-2 py-1 text-right"><span>Rp.
                                                </span>{{ $orderDetail->price_per_item }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                            <div class="flex justify-end mt-2 font-semibold text-lg">
                                <h3>total harga : {{ $order->total_price }}</h3>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
