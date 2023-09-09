<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <h2
            class="font-semibold mx-auto max-w-7xl sm:px-6 mb-3 lg:px-8 text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Layanan') }}
        </h2>
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('commision.update', $commision) }}" class="">
                        @csrf
                        @method('patch')
                        <div class="mb-6">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="block w-full mt-1"
                                required autofocus autocomplete="title" :value="old('title', $commision->title)" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-textarea-input id="description" name="description" type="text" class="block w-full mt-1"
                                required autofocus autocomplete="description">{{ $commision->description }}</x-textarea-input>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" name="price" type="number" class="block w-full mt-1"
                                required autofocus autocomplete="price" :value="old('price', $commision->price)" />
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="status" :value="__('Status')" />
                            <x-select id="status" name="status" class="block w-full mt-1">
                                <option value="0" {{ $commision->status == 0 ? 'selected' : '' }}>No Ready</option>
                                <option value="1" {{ $commision->status == 1 ? 'selected' : '' }}>Ready</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                            <x-cancel-button href="{{ route('profile.layanan',auth()->user()->name) }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
