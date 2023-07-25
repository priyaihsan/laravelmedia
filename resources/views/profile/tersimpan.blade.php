<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="static py-3 ">
        <div class="absolute w-full overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex flex-wrap lg:flex-nowrap p-6 text-gray-900 dark:text-gray-100">
                    <div class="w-full dark:bg-gray-600 lg:w-1/3 p-5 rounded-lg">
                        <div class="flex items-center">
                            <img class="w-16 h-16 lg:w-[150px] lg:h-[150px] object-cover rounded-full mr-2 border-[7px] border-indigo-600"
                                src="{{ auth()->user()->profile_picture }}" alt="">
                            <div class="flex lg:mt-5 mt-1 mx-4">
                                <div>
                                    <p class="text-lg font-bold">{{ auth()->user()->name }}</p>
                                    <p class="text-sm font-light dark:text-slate-400">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap mt-3 lg:justify-between md:justify-start text-base">
                            <div class="flex items-center me-2">
                                <p class="me-2 font-semibold text-gray-900 dark:text-white">{{ auth()->user()->posts_count }}</p>
                                <p class=" font-light dark:text-slate-200">postingan</p>
                            </div>
                            <div class="flex items-center me-2">
                                <p class="me-2 font-semibold text-gray-900 dark:text-white">{{ auth()->user()->follower_count }}</p>
                                <p class=" font-light dark:text-slate-200">follower</p>
                            </div>
                            <div class="flex items-center me-2">
                                <p class="me-2 font-semibold text-gray-900 dark:text-white">{{ auth()->user()->following_count }}</p>
                                <p class="font-light dark:text-slate-200">following</p>
                            </div>
                        </div>
                        <p class="text-lg font-medium mt-5">Biodata</p>
                        <div class="mt-2">
                            {{ auth()->user()->bio }}
                        </div>
                        <p class="text-lg font-medium mt-5">Role</p>
                        <div class="flex flex-wrap">
                            @foreach (auth()->user()->roles as $role)
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
                <div class="w-full mt-3 lg:mt-0 dark:bg-gray-600 lg:ms-2 p-5 rounded-lg">
                    <div class="">
                        <x-sub-link :href="route('profile.index')" :active="request()->routeIs('profile.index')">
                            {{ __('Post') }}
                        </x-sub-link>
                        <x-sub-link :href="route('profile.tersimpan')" :active="request()->routeIs('profile.tersimpan')">
                            {{ __('Tersimpan') }}
                        </x-sub-link>
                        <x-sub-link :href="route('post.create')">
                            {{ __('Create Post') }}
                        </x-sub-link>
                        <x-sub-link :href="route('profile.edit')">
                            {{ __('Edit Profile') }}
                        </x-sub-link>
                    </div>
                    <div class="flex flex-wrap h-[500px] w-full overflow-x-auto">
                        @foreach ($saveds as $saved)
                            {{-- start card social media --}}
                            <div
                                class="flex flex-col w-96 h-max mx-2 my-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <div>
                                    <button data-popover-target="popover-click-{{ $saved->post->id }}"
                                        data-popover-trigger="click" type="button"
                                        class="my-2 text-2xl px-6 font-bold text-left tracking-tight text-gray-900 dark:text-white hover:underline hover:decoration-solid">
                                        {{ $saved->post->title }}
                                    </button>
                                </div>
                                <div data-popover id="popover-click-{{ $saved->post->id }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                    <div
                                        class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                        <div class="flex items-center">
                                            <img class="bg-cover rounded-full w-10 h-10"
                                                src="{{ $saved->post->user->profile_picture }}" alt="">
                                            <p
                                                class="ms-2 text-base font-semibold leading-none text-gray-900 dark:text-white">
                                                {{ $saved->post->user->name }}</p>
                                        </div>
                                        <div class="flex items-center justify-between mt-2">
                                            <p><span class="font-semibold text-gray-900 dark:text-white">{{ $saved->post->user->follower_count }}</span> follower</p>
                                            <p><span class="font-semibold text-gray-900 dark:text-white">{{ $saved->post->user->following_count }}</span> following</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <a href="{{ route('post.edit', $saved->post) }}"
                                            class="p-3 dark:text-slate-500 hover:bg-gray-100 dark:hover:text-white dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out">Lihat Profile</a>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                                <div>
                                    <div class="h-26 overflow-hidden">
                                        <div class="font-normal line-clamp-3 px-6 text-gray-700 dark:text-gray-400">
                                            {{ $saved->post->content }}</div>
                                    </div>
                                    <p class="my-2 text-xs font-normal px-6 text-gray-700 dark:text-slate-500">
                                        {{ $saved->post->category->name }}, {{ $saved->post->type->name }}</p>
                                </div>
                                <div class="flex justify-end px-6 mb-1">
                                    <div class="flex justify-center items-center">
                                        {{-- start form likes --}}
                                        @if ($saved->post->is_likes)
                                            {{-- menyukai --}}
                                            <form action="{{ route('post.unlike', $saved->post) }}" method="POST">
                                                @csrf
                                                @method('delete')z
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
                            {{-- end card social media --}}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
