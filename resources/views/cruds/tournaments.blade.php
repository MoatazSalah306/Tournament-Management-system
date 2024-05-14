<div id="tournaments-crud" style="margin-top: 1.5rem" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <div class="text-center" style="margin-bottom: .7rem">
            <a href={{route("tournaments.create")}} class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">create tournament</a>
        </div>
        
        <table class="table-auto w-full text-center">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Events number</th>
                    <th class="px-4 py-2">category id</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tournaments as $tournament)
                <tr>
                    <td class="border px-4 py-2">{{$tournament->id}}</td>
                    <td class="border px-4 py-2">{{$tournament->name}}</td>
                    <td class="border px-4 py-2">{{$tournament->events_number}}</td>
                    <td class="border px-4 py-2">{{$tournament->category_id}}</td>
                    <td class="border px-4 py-2 text-center">
                        <a href={{route("tournaments.edit",$tournament->id)}} style="color: #fbbf24">edit</a>
                        <form action={{route("tournaments.destroy",$tournament->id)}} style="display: inline-block" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" style="color: #f87171;cursor: pointer;">delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>