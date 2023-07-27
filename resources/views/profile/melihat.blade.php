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
                        <x-sub-link active>
                            {{ __('Post') }}
                        </x-sub-link>
                    </div>
                    <div class="flex flex-wrap h-[500px] w-full overflow-x-auto">
                        @foreach ($user->posts as $post)
                            {{-- start card social media --}}
                            <div
                                class="flex flex-col justify-between w-96 h-max mx-2 my-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <div>
                                    <p class="my-2 text-2xl px-6 font-bold text-left tracking-tight text-gray-900 dark:text-white hover:underline hover:decoration-solid">
                                        {{ $post->title }}
                                    </p>
                                </div>
                                <div>
                                    <div class="h-26 overflow-hidden">
                                        <div class="font-normal line-clamp-3 px-6 text-gray-700 dark:text-gray-400">
                                            {{ $post->content }}</div>
                                    </div>
                                    <p class="my-2 text-xs font-normal px-6 text-gray-700 dark:text-slate-500">
                                        {{ $post->category->name }}, {{ $post->type->name }}</p>

                                </div>
                                <div class="flex justify-end px-6 mb-1">
                                    <div class="flex justify-center items-center">
                                        {{-- start form likes --}}
                                        @if ($post->is_likes)
                                            {{-- menyukai --}}
                                            <form action="{{ route('post.unlike', $post) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <x-card-button.like-button>
                                                    @if ($post->likes_count > 0)
                                                        {{ $post->likes_count }}
                                                    @else
                                                        0
                                                    @endif
                                                </x-card-button.like-button>
                                            </form>
                                        @else
                                            <form action="{{ route('post.like', $post) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                {{-- tidak menyukai --}}
                                                <x-card-button.unlike-button>
                                                    @if ($post->likes_count > 0)
                                                        {{ $post->likes_count }}
                                                    @else
                                                        0
                                                    @endif
                                                </x-card-button.unlike-button>
                                            </form>
                                        @endif
                                        {{-- end form likes --}}
                                        {{-- start form saveds --}}
                                        @if ($post->is_saved)
                                            {{-- tersimpan --}}
                                            <form action="{{ route('post.unsave', $post) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <x-card-button.saved-button>
                                                </x-card-button.saved-button>
                                            </form>
                                        @else
                                            {{-- tidak tersimpan --}}
                                            <form action="{{ route('post.save', $post) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <x-card-button.unsaved-button>
                                                </x-card-button.unsaved-button>
                                            </form>
                                        @endif
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
