<x-guest-layout>
    <form method="POST" action={{route("events.update",$event->id)}}>
        @csrf
        @method("PUT")
        <!-- Event Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <input id="name" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="text" name="name" value={{$event->name}} autofocus autocomplete="name" />
        </div>


        <!-- seats number -->
        <div class="mt-4">
            <x-input-label for="seats_number" :value="__('Seats number')" />
            <input id="seats_number" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="number" name="seats_number" value={{$event->seats_number}} autocomplete="seats_number" />
        </div>

        <!-- seats available -->
        <div class="mt-4">
            <x-input-label for="seats_available" :value="__('Seats available')" />
            <input id="seats_available" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="number" name="seats_available" value={{$event->seats_available}} autocomplete="seats_available" />
        </div>

        <!-- event type & Tournament that belongs to -->
        <div class="mt-4" style="display: flex;justify-content:space-between">
            <div>
                <x-input-label for="tournament" :value="__('Tournament that includes to ?')" />
                <select name="tournament" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @foreach ($tournaments as $tournament)
                            @if ($tournament->name == $event_tournament)
                            <option value={{$tournament->name}} selected>{{$tournament->name}}</option>
                            @else
                            <option value={{$tournament->name}}>{{$tournament->name}}</option>
                            @endif
                        @endforeach
                </select>
            </div>   

            <div>
                <x-input-label for="type" :value="__('Type ?')" />
                <select name="type" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @if ($event->type == "team")
                            <option value="team" selected>team</option>
                            <option value="individual">individual</option>
                        @elseif($event->type == "individual")
                            <option value="team">team</option>
                            <option value="individual" selected>individual</option>
                        @endif
                </select> 
            </div> 
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
