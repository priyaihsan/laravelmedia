<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2
                        class="font-semibold flex items-center justify-between mx-auto max-w-7xl mb-5 text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        <span>{{ __('Need To Payment') }}</span>
                        <span class="text-green-500">Total: Rp.{{ $order->total_price }}</span>
                    </h2>
                    <form method="post" action="{{ route('payment.store', $order->id) }}" class=""
                        enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="mb-6">
                            <x-input-label for="payment_method" :value="__('Pilih Metode Pembayaran')" />
                            <ul class="grid w-full gap-6 grid-cols-5 mt-2">
                                <li>
                                    <input type="radio" id="payment_method-1" name="payment_method" value="trakteer"
                                        class="hidden peer" required>
                                    <label for="payment_method-1"
                                        class="inline-flex items-center w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                        <img class="h-auto" src="/img/logo_payment/trakteer.png" alt="">
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" id="payment_method-2" name="payment_method" value="shopeePay"
                                        class="hidden peer">
                                    <label for="payment_method-2"
                                        class="inline-flex items-center w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                        <img class="h-auto" src="/img/logo_payment/shopepay.png" alt="">
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" id="payment_method-3" name="payment_method" value="dana"
                                        class="hidden peer">
                                    <label for="payment_method-3"
                                        class="inline-flex items-center w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                        <img class="h-auto" src="/img/logo_payment/dana.png" alt="">
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" id="payment_method-4" name="payment_method" value="ovo"
                                        class="hidden peer">
                                    <label for="payment_method-4"
                                        class="inline-flex items-center w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                        <img class="h-auto" src="/img/logo_payment/ovo.png" alt="">
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" id="payment_method-5" name="payment_method" value="linkAja"
                                        class="hidden peer">
                                    <label for="payment_method-5"
                                        class="inline-flex items-center w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                        <img class="h-auto" src="/img/logo_payment/linkaja.png" alt="">
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="mb-6">
                            <x-input-label for="payment_amount" :value="__('Jumlah Yang Dibayar')" />
                            <x-text-input id="payment_amount" name="payment_amount" type="number" class="block w-full mt-1"
                                required autofocus autocomplete="payment_amount" :value="old('payment_amount')" />
                            <x-input-error class="mt-2" :messages="$errors->get('payment_amount')" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="payer_information" :value="__('Bukti Pembayaran')" />
                            <x-file-input id="payer_information" name="payer_information" type="file"
                                class="block w-full mt-1" required autofocus autocomplete="payer_information"
                                :value="old('payer_information')"></x-file-input>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG
                                or GIF (MAX. 800x400px).</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                            <x-cancel-button href="{{ route('profile.checkout') }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
