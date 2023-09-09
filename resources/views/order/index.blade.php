<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Keranjang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($order)
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Nomor
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Nama Commision
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Mesan Dari
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            jumlah
                                        </th>
                                        <th scope="col" class="px-6 py-3 ">
                                            Harga Satuan
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total Harga
                                        </th>
                                        <th scope="col" class="px-6 py-3">

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderDetails as $orderDetail)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $count++ }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $orderDetail->commision->title }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $orderDetail->commision->user->name }}
                                            </td>
                                            <td class="px-6 py-4 flex items-center gap-4">
                                                {{-- button decreast quantity --}}
                                                @if ($orderDetail->quantity > 1)
                                                    <form
                                                        action="{{ route('orderDetail.decrement', $orderDetail->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('patch')
                                                        <button type="submit"
                                                            class="px-4 py-2 text-sm text-white bg-green-500 rounded-md hover:bg-green-600 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2
                                                    ">
                                                            -
                                                        </button>
                                                    </form>
                                                @else
                                                    <button
                                                        class="px-4 py-2 text-sm text-white bg-gray-500 hover:shadow-lg rounded-md">
                                                        -
                                                    </button>
                                                @endif

                                                <span>{{ $orderDetail->quantity }}</span>
                                                {{-- buttom increast quantity --}}
                                                <form action="{{ route('orderDetail.increment', $orderDetail->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('patch')
                                                    <button type="submit"
                                                        class="px-4 py-2 text-sm text-white bg-green-500 rounded-md hover:bg-green-600 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                                        +
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span>Rp.</span>{{ $orderDetail->commision->price }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <span>Rp.</span>{{ $orderDetail->price_per_item }}
                                            </td>
                                            <td>
                                                <form action="{{ route('orderDetail.destroy', $orderDetail->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-4 py-2 text-sm text-white bg-red-500 rounded-md hover:bg-red-600 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="px-6 py-4 flex justify-end gap-4 border-b border-gray-700">
                                <p class="font-medium">Total Harga :</p>
                                <p class="font-medium"><span>Rp.</span> {{ $order->total_price }}</p>
                            </div>
                            <div class="px-6 py-4 flex justify-end">
                                <form action="{{ route('order.checkout', $name) }}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <button type="submit"
                                        class="px-4 py-2 text-sm text-white bg-green-500 rounded-md hover:bg-green-600 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                        Checkout
                                    </button>
                                </form>

                            </div>
                        </div>
                    @else
                        <div class="relative overflow-x-auto">
                            <h5 class="text-center">Keranjang anda kosong</h5>
                        </div>
                    @endif

                </div>
            </div>
        </div>
</x-app-layout>
