<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <h2 class="font-semibold mx-auto max-w-7xl sm:px-6 mb-3 lg:px-8 text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Post') }}
        </h2>
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('post.update', $post) }}" class="">
                        @csrf
                        @method('patch')
                        <div class="mb-6">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="block w-full mt-1" required
                                autofocus autocomplete="title" :value="old('title', $post->title)" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="content" :value="__('Content')" />
                            <x-textarea-input id="content" name="content" type="text" class="block w-full mt-1" required
                                autofocus autocomplete="content" :value="old('content',$post->content)"></x-textarea-input>
                            <x-input-error class="mt-2" :messages="$errors->get('content')" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="category_id" :value="__('Category')" />
                            <x-select id="category_id" name="category_id" class="block w-full mt-1">
                                <option value="">Empty</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id')==$category->id ?
                                    'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="type_id" :value="__('Type')" />
                            <x-select id="type_id" name="type_id" class="block w-full mt-1">
                                <option value="">Empty</option>
                                @foreach ($types as $type)
                                <option value="{{ $type->id }}" {{ old('type_id')==$type->id ?
                                    'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                            <x-cancel-button href="{{ route('profile.index') }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
