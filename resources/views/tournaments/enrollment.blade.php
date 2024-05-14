

      
   
        @if ($user_enroll_as <> null)
            @if ($user_enroll_as == "team")
                <x-guest-layout>
                    <form method="POST" action={{route("enrollment")}}>
                        @csrf
                        <p class="block font-medium text-sm text-gray-700 dark:text-gray-300">You must choose at least 5 events</p>

                        <!-- events checkboxes-->
                         <div style="display: grid;grid-template-columns: repeat(2, minmax(0, 1fr));" class="divide-gray-200 dark:divide-gray-700">
                            @foreach ($events as $event)
                                @if ($event->type == "team" && $event->tournament_id == $tournament_id)
                                    <label class="flex cursor-pointer items-start gap-4 p-4 has-[:checked]:bg-blue-50 dark:has-[:checked]:bg-blue-700/10">
                                        <div class="flex items-center">
                                            <input
                                                type="checkbox"
                                                name={{$event->id}}
                                                class="size-4 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:ring-offset-gray-900"
                                            />
                                        </div>
                                        <div>
                                            <strong class="font-medium text-gray-900 dark:text-white"> {{$event->name}} </strong>
                                        </div>
                                    </label>
                                @endif
                            @endforeach
                        </div>

                        <!-- First Teammate Email -->
                        <div class="mt-4">
                            <x-input-label for="email1" :value="__('First Teammate Email')" />
                            <x-text-input id="email1" class="block mt-1 w-full" name="email1" :value="old('email1')" autocomplete="username" />
                            <span style="color: #F87171"> @error('email1'){{$message}}@enderror </span>
                        </div>

                        <!-- Second Teammate Email -->
                        <div class="mt-4">
                            <x-input-label for="email2" :value="__('Second Teammate Email')" />
                            <x-text-input id="email2" class="block mt-1 w-full" name="email2" :value="old('email2')" autocomplete="username" />
                            <span style="color: #F87171"> @error('email2'){{$message}}@enderror </span>
                        </div>

                        <!-- Third Teammate Email -->
                        <div class="mt-4">
                            <x-input-label for="email3" :value="__('Third Teammate Email')" />
                            <x-text-input id="email3" class="block mt-1 w-full" name="email3" :value="old('email3')" autocomplete="username" />
                            <span style="color: #F87171"> @error('email3'){{$message}}@enderror </span>
                        </div>

                        <!-- Fourth Teammate Email -->
                        <div class="mt-4">
                            <x-input-label for="email4" :value="__('Fourth Teammate Email')" />
                            <x-text-input id="email4" class="block mt-1 w-full" name="email4" :value="old('email4')" autocomplete="username" />
                            <span style="color: #F87171"> @error('email4'){{$message}}@enderror </span>
                        </div>

                        @if(session()->has('less_events'))
                             <span style="color:#F87171">{{session("less_events")}}</span>
                        @endif

                        @if(session()->has('fullfilledEvents'))
                            @foreach (session("fullfilledEvents") as $fullfilledEvent)
                                <p style="color:#F87171">{{$fullfilledEvent}} event is fullfilled.</p>
                            @endforeach
                        @endif


                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('home') }}">
                                {{ __('Cancel procces?') }}
                            </a>
                
                            <x-primary-button class="ms-4">
                                {{ __('Continue') }}
                            </x-primary-button>
                        </div>
                    </form>
                </x-guest-layout>  
            @elseif($user_enroll_as == "individual")
                <x-guest-layout>
                    <form method="POST" action={{route("enrollment")}}>
                        @csrf
                        
                        <p class="block font-medium text-sm text-gray-700 dark:text-gray-300">You must choose at least 5 events</p>

                        <!-- events checkboxes-->
                        <div class="divide-y divide-gray-200 dark:divide-gray-700">

                            @foreach ($events as $event)
                                @if ($event->type == "individual")
                                    @if ($event->tournament_id == $tournament_id)
                                        <label class="-mx-4 flex cursor-pointer items-start gap-4 p-4 has-[:checked]:bg-blue-50 dark:has-[:checked]:bg-blue-700/10">
                                            <div class="flex items-center">
                                                <input
                                                    type="checkbox"
                                                    name={{$event->id}}
                                                    class="size-4 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:ring-offset-gray-900"
                                                />
                                            </div>
                                    
                                            <div>
                                                <strong class="font-medium text-gray-900 dark:text-white"> {{$event->name}} </strong>
                                            </div>
                                        </label>
                                    @endif
                                @endif
                            @endforeach

                        </div>

                        @if(session()->has('less_events'))
                                <span style="color:#F87171">{{session("less_events")}}</span>
                        @endif

                        @if(session()->has('fullfilledEvents'))
                            @foreach (session("fullfilledEvents") as $fullfilledEvent)
                                <p style="color:#F87171">{{$fullfilledEvent}} event is fullfilled.</p>
                            @endforeach
                        @endif

                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('home') }}">
                                {{ __('Cancel procces?') }}
                            </a>
                
                            <x-primary-button class="ms-4">
                                {{ __('Continue') }}
                            </x-primary-button>
                        </div>
                    </form>
                </x-guest-layout>  
            @endif
        @else
        <x-guest-layout>
            <form method="POST" action={{route("users.enroll_as",$tournament_id)}}>
                @csrf
                @method("PUT")
                <!-- Enroll as -->
                <div class="mt-4">
                    <x-input-label :value="__('Enroll as?')" />
                    <select name="enroll_as" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="team">team</option>
                            <option value="individual">individual</option>
                    </select>   
                </div>  
                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('home') }}">
                        {{ __('Cancel procces?') }}
                    </a>
        
                    <x-primary-button class="ms-4">
                        {{ __('Continue') }}
                    </x-primary-button>
                </div>
            </form>
        </x-guest-layout>  
        @endif


        
