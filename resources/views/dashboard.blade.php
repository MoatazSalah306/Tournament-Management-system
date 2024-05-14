<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #9CA3AF">
            @if ($role == "superadmin")
                {{ ("SuperAdmin Dashboard")}}
            @elseif($role == "admin")
                {{ ("Admin Dashboard")}}
            @elseif($role == "user")
                {{ ("User Dashboard")}}
            @endif
            
        </h2>
    </x-slot>

        
            

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
                    {{-- superadmin --}}
                    @if ($role == "superadmin")
                    <div id="users-crud" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100"> 
                            <div class="text-center" style="margin-bottom: .7rem">
                                <a href={{route("users.create")}} class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">create user</a>
                            </div>
                            <table class="table-auto w-full">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">ID</th>
                                        <th class="px-4 py-2">Name</th>
                                        <th class="px-4 py-2">Email</th>
                                        <th class="px-4 py-2">Role</th>
                                        <th class="px-4 py-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userswithadmins as $user)
                                        <tr>
                                            <td class="border px-4 py-2">{{$user->id}}</td>
                                            <td class="border px-4 py-2">{{$user->name}}</td>
                                            <td class="border px-4 py-2">{{$user->email}}</td>
                                            <td class="border px-4 py-2">{{$user->role}}</td>
                                            <td class="border px-4 py-2 text-center">
                                                <a href={{route("users.edit",$user->id)}} style="color: #fbbf24">edit</a>
                                                <form style="display: inline-block" method="POST" action={{route("users.destroy",$user->id)}}>
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

                    @include('cruds.categories')
                    @include('cruds.tournaments')
                    @include('cruds.events')
                    @include('pages.events_subscribtions')
                    @include('pages.scores')

                    {{-- admin --}}
                    @elseif($role == "admin")

                    <div id="users-crud" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="text-center" style="margin-bottom: .7rem">
                                <a href={{route("users.create")}} class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">create user</a>
                            </div>
                            <table class="table-auto w-full text-center">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">ID</th>
                                        <th class="px-4 py-2">Name</th>
                                        <th class="px-4 py-2">Email</th>
                                        <th class="px-4 py-2">Role</th>
                                        <th class="px-4 py-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="border px-4 py-2">{{$user->id}}</td>
                                            <td class="border px-4 py-2">{{$user->name}}</td>
                                            <td class="border px-4 py-2">{{$user->email}}</td>
                                            <td class="border px-4 py-2">{{$user->role}}</td>
                                            <td class="border px-4 py-2 text-center">
                                                <a href={{route("users.edit",$user->id)}} style="color: #fbbf24">edit</a>
                                                <form style="display: inline-block" method="POST" action={{route("users.destroy",$user->id)}}>
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

                    @include('cruds.categories')
                    @include('cruds.tournaments')
                    @include('cruds.events')
                    

                    {{-- user --}}
                    @elseif($role == "user")
                        
                        <div class="text-2xl font-extrabold text-[#9CA3AF] sm:text-5xl text-center opacity-20 font-mono">OUR TOURNAMENTS</div>
                        <div class="text-center mt-5"><a href={{route("score.index",$id)}} class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Score</a></div>
                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8 m-10">
                            @foreach ($tournaments as $tournament)
                                <div style="height:max-content" class="py-4 rounded-lg font-mono bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-white grid justify-center text-center items-center">
                                   <div>
                                        <p class="text-lg"><span class="text-indigo-600">Name: </span>{{$tournament->name}}</p> 
                                        @foreach ($categories as $category)
                                            @if ( $category->id == $tournament->category_id )
                                                <p><span class="text-indigo-600">Category: </span>{{$category->name}}</p>
                                            @endif
                                        @endforeach
                                        <p class="text-neutral-400">{{$tournament->description}}</p>
                                        <p><span class="text-indigo-600">Events number: </span> {{$tournament->events_number}}</p>
                                        <a href={{route("tournaments.enroll",$tournament->id)}} class="mt-3 justify-center w-full inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                            Enroll Now!!
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            
                        </div>

                    @endif
             
        </div>
    </div>
</x-app-layout>
