<x-guest-layout>
    <form method="POST" action={{route("tournaments.store")}}>
        @csrf

        <!-- Tournament Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
            <span style="color: #F87171"> @error('name'){{$message}}@enderror </span>
        </div>

        <!-- Tournament Description -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" autocomplete="description" />
            <span style="color: #F87171"> @error('description'){{$message}}@enderror </span>
        </div>

        <!-- Tournament Events_num -->
        <div class="mt-4">
            <x-input-label for="events_number" :value="__('Events number')" />
            <x-text-input id="events_number" class="block mt-1 w-full" type="number" name="events_number" :value="old('events_number')" autocomplete="events_number" />
            <span style="color: #F87171"> @error('events_number'){{$message}}@enderror </span>
        </div>

        <!-- Category -->
        <div class="mt-4">
            <x-input-label for="category" :value="__('Category')" />
            <select name="category" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                @foreach ($categories as $category)
                    <option value={{$category->id}}>{{$category->name}}</option>
                @endforeach
            </select>   
        </div>

       


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('home') }}">
                {{ __('Cancel procces?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Create') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
