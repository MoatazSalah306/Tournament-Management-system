<x-guest-layout>
    <form method="POST" action={{route("events.store")}}>
        @csrf

        <!-- Event Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
            <span style="color: #F87171"> @error('name'){{$message}}@enderror </span>
        </div>


        <!-- seats number -->
        <div class="mt-4">
            <x-input-label for="seats_number" :value="__('Seats number')" />
            <x-text-input id="seats_number" class="block mt-1 w-full" type="number" name="seats_number" :value="old('seats_number')" autocomplete="seats_number" />
            <span style="color: #F87171"> @error('seats_number'){{$message}}@enderror </span>
        </div>

        <!-- seats available -->
        <div class="mt-4">
            <x-input-label for="seats_available" :value="__('Seats available')" />
            <x-text-input id="seats_available" class="block mt-1 w-full" type="number" name="seats_available" :value="old('seats_available')" autocomplete="seats_available" />
            <span style="color: #F87171"> @error('seats_available'){{$message}}@enderror </span>
        </div>

        <!-- event type & Tournament that belongs to -->
        <div class="mt-4" style="display: flex;justify-content:space-between">
            <div>
                <x-input-label for="tournament" :value="__('Tournament that includes to ?')" />
                <select name="tournament" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @foreach ($tournaments as $tournament)
                            <option value={{$tournament->id}}>{{$tournament->name}}</option>
                        @endforeach
                </select>
            </div>   

            <div>
                <x-input-label for="type" :value="__('Type ?')" />
                <select name="type" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="team">team</option>
                        <option value="individual">individual</option>
                </select> 
            </div> 
        </div>

        @if(session()->has('limit'))
            {{-- Variable is provided --}}
            <span style="color: #F87171">{{session("limit")}}</span>
        @endif
           



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
