<div id="categories-crud" style="margin-top: 1.5rem" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <div class="text-center" style="margin-bottom: .7rem">
            <a href={{route("categories.create")}} class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">create category</a>
        </div>
        <table class="table-auto w-full text-center">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td class="border px-4 py-2">{{$category->id}}</td>
                    <td class="border px-4 py-2">{{$category->name}}</td>
                    <td class="border px-4 py-2 text-center">
                        <a href={{route("categories.edit",$category->id)}} style="color: #fbbf24">edit</a>
                        <form action={{route("categories.destroy",$category->id)}} style="display: inline-block" method="POST">
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