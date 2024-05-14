<div id="events_subscribtions-page" style="margin-top: 1.5rem" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <div class="text-center" style="margin-bottom: .7rem">
            <p class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">Events subscribtions</p>
        </div>
        <table class="table-auto w-full text-center">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Team IDs</th>
                    <th class="px-4 py-2">User ID</th>
                    <th class="px-4 py-2">Event ID</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($event_subscribtions as $event_subscribtion)
                <tr>
                    <td class="border px-4 py-2">{{$event_subscribtion->id}}</td>
                    <td class="border px-4 py-2">{{$event_subscribtion->team_ids}}</td>
                    <td class="border px-4 py-2">{{$event_subscribtion->user_id}}</td>
                    <td class="border px-4 py-2">{{$event_subscribtion->event_id}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>