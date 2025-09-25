<!-- resources/views/questions/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $question->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Question Details -->
                    <h1 class="text-3xl font-bold mb-4 text-gray-900 dark:text-gray-100">{{ $question->title }}</h1>
                    <p class="text-lg mb-4 text-gray-700 dark:text-gray-300">{{ $question->body }}</p>

                    <div class="text-sm text-gray-500 dark:text-gray-400 mb-6 border-b pb-4">
                        <p>
                            විසින්: {{ $question->is_anonymous ? 'නිර්නාමිකයි' : $question->user->name }}
                            <span class="ml-4">පළ කළ දිනය: {{ $question->created_at->diffForHumans() }}</span>
                        </p>
                        <p>බැලූ වාර: {{ $question->views_count }}</p>
                    </div>

                    <div class="text-sm text-gray-500 dark:text-gray-400 mb-6 border-b pb-4">
                        @if ($question->category)
                            <p>
                                කාණ්ඩය:
                                <a href="#" class="inline-block bg-gray-200 dark:bg-gray-600 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 dark:text-gray-200 mr-2 mb-2 hover:bg-gray-300 dark:hover:bg-gray-500">
                                    {{ $question->category->name }}
                                </a>
                            </p>
                        @endif
                    </div>

                    <!-- Answers Section -->
                    <h3 class="text-2xl font-bold mt-8 mb-4 text-gray-900 dark:text-gray-100">
                        {{ __('පිළිතුරු') }} ({{ $question->answers->count() }})
                    </h3>
                    <div class="space-y-6">
                        @forelse ($question->answers as $answer)
                            <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow">
                                <p class="text-gray-800 dark:text-gray-200">{{ $answer->body }}</p>
                                <div class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                    පිළිතුරු දුන්නේ: {{ $answer->user->name }}
                                    <span class="ml-4">{{ $answer->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-600 dark:text-gray-400">{{ __('තවම කිසිදු පිළිතුරක් නොමැත.') }}</p>
                        @endforelse
                    </div>

                    <!-- Post an Answer Form -->
                    @auth
                        <div class="mt-8 p-4 bg-gray-50 dark:bg-gray-900/50 rounded-lg shadow">
                            <h4 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">{{ __('පිළිතුරක් පළ කරන්න') }}</h4>
                            <form method="POST" action="{{ route('answers.store', $question) }}">
                                @csrf
                                <textarea name="body" rows="5" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" placeholder="ඔබගේ පිළිතුර මෙහි ඇතුළත් කරන්න..." required>{{ old('body') }}</textarea>
                                <x-input-error :messages="$errors->get('body')" class="mt-2" />
                                <div class="mt-4">
                                    <x-primary-button>
                                        {{ __('පිළිතුර පළ කරන්න') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    @else
                        <p class="mt-8 text-center text-gray-600 dark:text-gray-400">
                            <a href="{{ route('login') }}" class="font-bold underline">පිළිතුරු පළ කිරීමට ලොග් වන්න</a>
                        </p>
                    @endauth

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
