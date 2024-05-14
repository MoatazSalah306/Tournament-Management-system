<x-guest-layout>
    <form method="POST" action={{route("tournaments.update",$tournament->id)}}>
        @csrf
        @method("PUT")

        <!-- Tournament Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <input id="name" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="text" name="name" value={{$tournament->name}} autofocus autocomplete="name" />
        </div>

        <!-- Tournament Description -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <input id="description" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="text" name="description" value={{$tournament->description}} autocomplete="description" />
        </div>

        <!-- Tournament Events_num -->
        <div class="mt-4">
            <x-input-label for="events_number" :value="__('Events number')" />
            <input id="events_number" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="number" name="events_number" value={{$tournament->events_number}} autocomplete="events_number" />
        </div>

        <!-- Category -->
        <div class="mt-4">
            <x-input-label for="category" :value="__('Category')" />
            <select name="category" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" value={{$tournament->category}}>
                @foreach ($categories as $category)
                    @if ($category->name == $tournament_category)
                    <option value={{$category->name}} selected>{{$category->name}}</option>
                    @else
                    <option value={{$category->name}}>{{$category->name}}</option>
                    @endif

                @endforeach
            </select>   
        </div>

       


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('home') }}">
                {{ __('Cancel procces?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Update') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
