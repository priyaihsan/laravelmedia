<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:ring-slate-300 font-medium rounded-lg text-xs px-3 py-1.5 dark:bg-slate-600 dark:hover:bg-slate-700 focus:outline-none dark:focus:ring-slate-800']) }}type="submit">{{ $slot }}</button>
