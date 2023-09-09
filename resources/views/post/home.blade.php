<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 grid grid-cols-1 md:grid-cols-4 gap-4 h-[500px] w-full text-gray-900 dark:text-gray-100">
                @foreach ($posts as $post)
                    <div class="h-fit bg-white border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        {{-- modal detail post --}}
                        <button data-modal-target="defaultModal-{{ $post->id }}"
                            data-modal-toggle="defaultModal-{{ $post->id }}" type="button" class="w-full">
                            <img class="rounded-t-lg h-[200px] w-full object-cover object-top"
                                src="{{ asset('storage/' . $post->content_url) }}" alt="" />
                        </button>
                        <!-- Main modal -->
                        <div id="defaultModal-{{ $post->id }}" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full lg:p-5 p-8  overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal body -->
                                    <div class="grid grid-cols-1  lg:grid-cols-2">
                                        <div>
                                            <img class="lg:rounded-l-lg rounded-t-lg w-full h-auto"
                                                src="{{ asset('storage/' . $post->content_url) }}" alt="">
                                        </div>
                                        <div class="p-3 flex flex-col justify-between">
                                            <div>
                                                <div class="hidden lg:flex items-end">
                                                    <button type="button"
                                                        data-modal-hide="defaultModal-{{ $post->id }}"
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-hide="defaultModal">
                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div>
                                                    <h5
                                                        class=" text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                        {{ $post->title }}</h5>
                                                    @if ($post->user->id != auth()->user()->id)
                                                        <a href="{{ route('profile.layanan', $post->user->name) }}"
                                                            class="flex items-center text-left gap-2 w-full hover:bg-gray-500 p-2 rounded-lg">
                                                            <img class="rounded-full w-10 h-10"
                                                                src="{{ $post->user->profile_picture }}" alt="">
                                                            <div class="flex flex-col">
                                                                <h5
                                                                    class=" text-base font-bold tracking-tight text-gray-900 dark:text-white">
                                                                    {{ $post->user->name }}</h5>
                                                                <p class="text-sm text-gray-700 dark:text-gray-400">
                                                                    {{ $post->user->followers_count }}<span
                                                                        class="ms-1 ">followers ,</span>
                                                                    {{ $post->user->followings_count }}<span
                                                                        class="ms-1 ">following</span>
                                                                </p>
                                                            </div>
                                                        </a>
                                                    @else
                                                        <div class="flex items-center text-left gap-2 w-full ">
                                                            <img class="rounded-full w-10 h-10"
                                                                src="{{ $post->user->profile_picture }}"
                                                                alt="">
                                                            <div class="flex flex-col">
                                                                <h5
                                                                    class=" text-base font-bold tracking-tight text-gray-900 dark:text-white">
                                                                    {{ $post->user->name }}</h5>
                                                                <p class="text-sm text-gray-700 dark:text-gray-400">
                                                                    {{ $post->user->followers_count }}<span
                                                                        class="ms-1 ">followers ,</span>
                                                                    {{ $post->user->followings_count }}<span
                                                                        class="ms-1 ">following</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div
                                                        class="flex flex-wrap lg:flex-nowrap items-center gap-2 mx-3 my-3">
                                                        @if ($post->user->id != auth()->user()->id)
                                                            <x-card-button.message-button>
                                                                Pesan
                                                            </x-card-button.message-button>
                                                            {{-- buat agar bisa saling follow dan followed --}}
                                                            @if ($post->user->is_user_follower)
                                                                <form class="w-full"
                                                                    action="{{ route('user.unfollow', $post->user) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <x-card-button.followed-button>
                                                                        Followed
                                                                    </x-card-button.followed-button>
                                                                </form>
                                                            @else
                                                                <form class="w-full"
                                                                    action="{{ route('user.follow', $post->user) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <x-card-button.follow-button>
                                                                        Follow
                                                                    </x-card-button.follow-button>
                                                                </form>
                                                            @endif
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="flex items-center justify-between border-t border-gray-600 pt-2">
                                                <p class="text-sm text-gray-700 dark:text-gray-400">
                                                    {{ $post->category->name }} , {{ $post->type->name }}</p>
                                                <div class="flex items-center ">
                                                    {{-- start form likes --}}
                                                    @if ($post->is_likes)
                                                        {{-- menyukai --}}
                                                        <form action="{{ route('post.unlike', $post) }}"
                                                            method="POST">
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
                                                        <form action="{{ route('post.unsave', $post) }}"
                                                            method="POST">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-3 py-2">
                            <div class="flex flex-col items-start">
                                <h5 class=" text-base font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $post->title }}</h5>
                                <p class="text-sm text-gray-700 dark:text-gray-400">
                                    {{ $post->category->name }} , {{ $post->type->name }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
