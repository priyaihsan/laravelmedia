<button {{ $attributes->merge(['type' => 'submit' , 'class' => 'flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-dark dark:bg-blue-400 dark:text-slate-100 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500']) }}
    >{{ $slot }}</button>
