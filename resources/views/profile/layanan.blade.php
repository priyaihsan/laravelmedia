<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="px-12">
        @if (session('success'))
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                class="pb-3 text-sm text-green-600 dark:text-green-400">{{ session('success') }}
            </p>
        @endif
        @if (session('danger'))
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                class="pb-3 text-sm text-red-600 dark:text-red-400">{{ session('danger') }}
            </p>
        @endif
    </div>
    <div class="static py-3 ">
        <div class="absolute w-full overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex flex-wrap lg:flex-nowrap p-6 text-gray-900 dark:text-gray-100">
                @foreach ($user as $user)
                    <div class="w-full dark:bg-gray-600 lg:w-1/3 p-5 rounded-lg">
                        <div class="flex items-center">
                            <img class="w-11 h-11 lg:w-16 lg:h-16 object-cover rounded-full mr-2 "
                                src="{{ $user->profile_picture }}" alt="">
                            <div class="flex lg:mt-5 mt-1 mx-4">
                                <div>
                                    <p class="text-lg font-bold">{{ $user->name }}</p>
                                    <p class="text-sm font-light dark:text-slate-400">{{ $user->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap mt-3 lg:justify-between md:justify-start text-base">
                            <div class="flex items-center me-2">
                                <p class="me-2 font-bold">{{ $user->posts_count }}</p>
                                <p class=" font-light dark:text-slate-200">postingan</p>
                            </div>
                            <div class="flex items-center me-2">
                                <p class="me-2 font-bold">{{ $user->followers_count }}</p>
                                <p class=" font-light dark:text-slate-200">follower</p>
                            </div>
                            <div class="flex items-center me-2">
                                <p class="me-2 font-bold">{{ $user->followings_count }}</p>
                                <p class="font-light dark:text-slate-200">following</p>
                            </div>
                        </div>
                        @if ($name != auth()->user()->name)
                            <div class="flex justify-between gap-2 mt-2">
                                <x-card-button.message-button>
                                    Pesan
                                </x-card-button.message-button>
                                {{-- buat agar bisa saling follow dan followed --}}
                                @if ($user->is_user_follower)
                                    <form class="w-full" action="{{ route('user.unfollow', $user) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <x-card-button.followed-button>
                                            Followed
                                        </x-card-button.followed-button>
                                    </form>
                                @else
                                    <form class="w-full" action="{{ route('user.follow', $user) }}" method="post">
                                        @csrf
                                        <x-card-button.follow-button>
                                            Follow
                                        </x-card-button.follow-button>
                                    </form>
                                @endif
                            </div>
                        @else
                            <div class="mt-2">
                                {{-- blue button edit profile --}}
                                <a href="{{ route('profile.edit') }}"
                                    class="flex items-center justify-center w-full px-4 py-2  text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Edit Profile
                                </a>
                            </div>
                        @endif
                        <p class="text-lg font-medium mt-5">Biodata</p>
                        <div class="mt-2">
                            {{ $user->bio }}
                        </div>
                        <p class="text-lg font-medium mt-5">Role</p>
                        <div class="flex flex-wrap">
                            @foreach ($user->roles as $role)
                                <p
                                    class="flex px-4 py-4 h-10 w-auto my-1 mx-1 items-center text-sm text-white bg-dark dark:bg-slate-700 dark:text-slate-100 rounded-full">
                                    {{ $role->name }}</p>
                            @endforeach
                        </div>
                        <p class="text-lg font-medium mt-5">Social Media</p>
                        <div class="flex">
                            {{-- twitter --}}
                            <x-link-twitter>
                            </x-link-twitter>
                            {{-- instagram --}}
                            <x-link-insta>
                            </x-link-insta>
                            {{-- link --}}
                            <x-link-linkin>
                            </x-link-linkin>
                        </div>
                    </div>
                @endforeach
                <div class="w-full mt-3 lg:mt-0 dark:bg-gray-600 lg:ms-2 p-5 rounded-lg">
                    <div class="flex justify-between">
                        <div class="flex flex-wrap gap-2">
                            <x-sub-link :href="route('profile.layanan', $name)" :active="request()->routeIs('profile.layanan')">
                                {{ __('Layanan') }}
                            </x-sub-link>
                            <x-sub-link :href="route('profile.index', $name)" :active="request()->routeIs('profile.index')">
                                {{ __('Dibuat') }}
                            </x-sub-link>
                            @if ($name == auth()->user()->name)
                                <x-sub-link :href="route('profile.tersimpan', $name)" :active="request()->routeIs('profile.tersimpan')">
                                    {{ __('Disimpan') }}
                                </x-sub-link>
                                <x-sub-link :href="route('profile.checkout')" :active="request()->routeIs('profile.checkout')">
                                    {{ __('Checkout') }}
                                </x-sub-link>
                            @endif
                        </div>
                        @if ($name != auth()->user()->name)
                            <x-back-button class="mx-6" href="{{ route('post.index') }}" />
                        @endif
                    </div>
                    {{-- blue button Buat Layanan Baru --}}
                    <div>
                        @if ($name == auth()->user()->name)
                            <a href="{{ route('commision.create') }}"
                                class="flex items-center justify-center w-full px-4 py-2 mt-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Buat Layanan Baru
                            </a>
                        @endif
                    </div>
                    <div class=" h-[500px] w-full overflow-x-auto">
                        @foreach ($commisions as $commision)
                            <div
                                class="w-full my-2 p-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <div class="flex flex-wrap items-center justify-between">
                                    <div class="lg:w-3/4 w-full">
                                        <div class="flex items-center gap-3">
                                            <h5 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                {{ $commision->title }}</h5>
                                            @if ($commision->status == 0)
                                                <span
                                                    class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Not
                                                    Ready</span>
                                            @else
                                                <span
                                                    class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Ready</span>
                                            @endif
                                        </div>
                                        <p class="text-lg font-medium mt-5 ">Deskripsi</p>
                                        <div class="w-3/4 mb-2">
                                            <p class="font-normal text-gray-700 dark:text-gray-400 whitespace-pre-line">
                                                {{ $commision->description }}</p>
                                        </div>
                                        </p>
                                    </div>
                                    <div class="w-auto">
                                        <h5
                                            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                            Rp {{ $commision->price }}</h5>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">

                                    @if ($name != auth()->user()->name)
                                        {{-- blue button add to cart --}}
                                        @if ($commision->status == 1)
                                            <form method="post" action="{{ route('orderDetail.addToCard', $name) }}">
                                                @csrf
                                                @method('post')
                                                <x-text-input id="price_per_item" name="price_per_item" type="number"
                                                    class="hidden w-full mt-1" required autofocus
                                                    autocomplete="price_per_item" :value="old('price_per_item', $commision->price)" />
                                                <x-text-input id="id" name="id" type="number"
                                                    class="hidden w-full mt-1" required autofocus autocomplete="id"
                                                    :value="old('id', $commision->id)" />
                                                <x-card-button.cart-button>
                                                </x-card-button.cart-button>
                                            </form>
                                        @endif
                                        <div class="flex items-center gap-3">
                                            @foreach ($orderDetails as $orderDetail)
                                                @if ($orderDetail)
                                                    @if ($commision->id == $orderDetail->commision_id)
                                                        <p><span>Jumlah Pesanan : </span>{{ $orderDetail->quantity }}
                                                        </p>
                                                        <p><span>Sub Harga : </span>{{ $orderDetail->price_per_item }}
                                                        </p>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="flex items-center justify-between w-full">
                                            <div class="flex items-center">
                                                <a href="{{ route('commision.edit', $commision) }}"
                                                    class="p-3 rounded-lg dark:text-slate-500 hover:bg-gray-100 dark:hover:text-white dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out">Edit
                                                    Layanan</a>
                                                <form action="{{ route('commision.destroy', $commision) }}"
                                                    method="Post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="p-3 rounded-lg dark:text-red-50 hover:bg-gray-100 dark:hover:text-red-500 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out">
                                                        Delete Layanan
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="flex items-center gap-3">
                                                @foreach ($orderDetails as $orderDetail)
                                                    @if ($orderDetail)
                                                        @if ($commision->id == $orderDetail->commision_id)
                                                            <p><span>Jumlah Yang Sudah Terjual :
                                                                </span>{{ $orderDetail->quantity }}
                                                            </p>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</x-app-layout>
