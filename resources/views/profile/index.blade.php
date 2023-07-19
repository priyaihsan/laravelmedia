<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="static py-3 ">
        <div class="absolute w-full overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex flex-wrap lg:flex-nowrap p-6 text-gray-900 dark:text-gray-100">
                @foreach ($user as $user)
                    <div class="w-full dark:bg-gray-600 lg:w-1/3 p-5 rounded-lg">
                        <div class="flex items-center">
                            <img class="w-16 h-16 lg:w-[150px] lg:h-[150px] object-cover rounded-full mr-2 border-[7px] border-indigo-600"
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
                                <p class="me-2 font-bold">11{{ $user->posts_count }}</p>
                                <p class=" font-light dark:text-slate-200">postingan</p>
                            </div>
                            <div class="flex items-center me-2">
                                <p class="me-2 font-bold">{{ $user->follower_count }}</p>
                                <p class=" font-light dark:text-slate-200">follower</p>
                            </div>
                            <div class="flex items-center me-2">
                                <p class="me-2 font-bold">{{ $user->following_count }}</p>
                                <p class="font-light dark:text-slate-200">following</p>
                            </div>
                        </div>
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
                    <div class="">
                        <x-sub-link :href="route('profile.index')" :active="request()->routeIs('profile.index')">
                            {{ __('Post') }}
                        </x-sub-link>
                        <x-sub-link :href="route('profile.tersimpan')" :active="request()->routeIs('profile.tersimpan')">
                            {{ __('Tersimpan') }}
                        </x-sub-link>
                        <x-sub-link :href="route('profile.edit')">
                            {{ __('Create Post') }}
                        </x-sub-link>
                        <x-sub-link :href="route('profile.edit')">
                            {{ __('Edit Profile') }}
                        </x-sub-link>
                    </div>
                    <div class="flex flex-wrap h-[500px] w-full overflow-x-auto">
                        @foreach (range(1, 10) as $i)
                            {{-- start card social media --}}
                            <div
                                class="flex flex-col justify-between w-96 h-auto mx-2 my-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <div class="flex items-center justify-between">
                                    <button data-popover-target="popover-click-{{ $i }}"
                                        data-popover-trigger="click" type="button"
                                        class="my-2 text-2xl px-6 font-bold text-left tracking-tight text-gray-900 dark:text-white hover:underline hover:decoration-solid">
                                        Test Post
                                    </button>

                                </div>
                                <div data-popover id="popover-click-{{ $i }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                    <div
                                        class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Test Post</h3>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <a href=""
                                            class="p-3 dark:text-slate-500 hover:bg-gray-100 dark:hover:text-white dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out">Edit
                                            Post</a>
                                        <form action="" method="Post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="p-3 dark:text-red-50 hover:bg-gray-100 dark:hover:text-red-500 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out">
                                                Delete Post
                                            </button>
                                        </form>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                                <div>
                                    <p class="font-normal px-6 text-gray-700 dark:text-gray-400">Lorem, ipsum dolor sit
                                        amet
                                        consectetur adipisicing elit. Possimus dignissimos, doloribus adipisci quos
                                        officia
                                        vero omnis odio, aspernatur perferendis, eius voluptatibus.</p>
                                    <p class="my-2 text-xs font-normal px-6 text-gray-700 dark:text-slate-500">
                                        vidio, 3D art</p>
                                </div>
                                <div class="flex justify-end px-6 mb-1">
                                    <div class="flex justify-center items-center">
                                        {{-- start form likes --}}
                                        <x-card-button.like-button>
                                            12
                                        </x-card-button.like-button>
                                        {{-- end form likes --}}
                                        {{-- start form saveds --}}
                                        <x-card-button.saved-button>
                                        </x-card-button.saved-button>
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
