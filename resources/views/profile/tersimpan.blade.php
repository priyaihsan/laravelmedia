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
                            <img class="w-11 h-11 lg:w-16 lg:h-16 object-cover rounded-full mr-2"
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
                        @if ($user->id != auth()->user()->id)
                            <div class="flex justify-between gap-2 mt-2">
                                {{-- blue button follow --}}
                                <button
                                    class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Ikuti
                                    {{-- button message --}}
                                    <button
                                        class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-dark dark:bg-slate-700 dark:text-slate-100 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        Pesan
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
                    <div class="flex flex-wrap gap-2">
                        <x-sub-link :href="route('profile.layanan',auth()->user()->name)" :active="request()->routeIs('profile.layanan')">
                            {{ __('Layanan') }}
                        </x-sub-link>
                        <x-sub-link :href="route('profile.index',auth()->user()->name)" :active="request()->routeIs('profile.index')">
                            {{ __('Dibuat') }}
                        </x-sub-link>
                        <x-sub-link :href="route('profile.tersimpan',auth()->user()->name)" :active="request()->routeIs('profile.tersimpan')">
                            {{ __('Disimpan') }}
                        </x-sub-link>
                        <x-sub-link :href="route('profile.checkout')" :active="request()->routeIs('profile.checkout')">
                            {{ __('Checkout') }}
                        </x-sub-link>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 h-[500px] w-full overflow-x-auto">
                        @foreach ($saveds as $saved)
                            <div
                                class="h-fit bg-white border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <img class="rounded-t-lg h-[200px] w-full object-cover object-top"
                                    src="{{ asset('storage/' . $saved->post->content_url) }}" alt="" />
                                <div class="px-3 py-2">
                                    <h5 class=" text-base font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{ $saved->post->title }}</h5>

                                    <div class="flex items-center justify-between mb-2 mt-3">
                                        <p class="mb-4 text-sm text-gray-700 dark:text-gray-400">
                                            {{ $saved->post->category->name }} ,
                                            {{ $saved->post->type->name }}
                                        </p>
                                        <div class="flex items-center">
                                            {{-- start form likes --}}
                                            @if ($saved->post->is_likes)
                                                {{-- menyukai --}}
                                                <form action="{{ route('post.unlike', $saved->post) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <x-card-button.like-button>
                                                        @if ($saved->post->likes_count > 0)
                                                            {{ $saved->post->likes_count }}
                                                        @else
                                                            0
                                                        @endif
                                                    </x-card-button.like-button>
                                                </form>
                                            @else
                                                <form action="{{ route('post.like', $saved->post) }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    {{-- tidak menyukai --}}
                                                    <x-card-button.unlike-button>
                                                        @if ($saved->post->likes_count > 0)
                                                            {{ $saved->post->likes_count }}
                                                        @else
                                                            0
                                                        @endif
                                                    </x-card-button.unlike-button>
                                                </form>
                                            @endif
                                            {{-- end form likes --}}
                                            {{-- start form saveds --}}
                                            {{-- tersimpan --}}
                                            <form action="{{ route('post.unsave', $saved->post) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <x-card-button.saved-button>
                                                </x-card-button.saved-button>
                                            </form>
                                            {{-- end form saveds --}}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
