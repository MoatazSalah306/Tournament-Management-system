<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #9CA3AF">
                {{ ("Score page")}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-2xl font-extrabold text-[#9CA3AF] sm:text-5xl text-center opacity-20 font-mono">
                @if (count($score)<>0)
                    Your score is : {{$score[0]->score}}
                @else
                Yuor score is : 0
                @endif
            </div>
        </div>
    </div>
</x-app-layout>