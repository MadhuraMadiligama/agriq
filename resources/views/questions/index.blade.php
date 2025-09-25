<!-- resources/views/questions/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('සියලුම ප්‍රශ්න') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="flex justify-end mb-4">
                        <a href="{{ route('questions.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('ප්‍රශ්නයක් අසන්න') }}
                        </a>
                    </div>

                    @forelse ($questions as $question)
                        <div class="mb-6 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                                <a href="{{ route('questions.show', $question->slug) }}" class="hover:underline">
                                    {{ $question->title }}
                                </a>
                            </h3>
                            <p class="text-gray-700 dark:text-gray-300 mb-2">
                                {{ Str::limit($question->body, 150) }}
                            </p>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                <p>
                                    විසින්: {{ $question->is_anonymous ? 'නිර්නාමිකයි' : $question->user->name }}
                                    <span class="ml-4">පළ කළ දිනය: {{ $question->created_at->diffForHumans() }}</span>
                                </p>
                                <p>බැලූ වාර: {{ $question->views_count }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600 dark:text-gray-400">{{ __('තවම කිසිදු ප්‍රශ්නයක් පළ කර නොමැත.') }}</p>
                    @endforelse

                    <div class="mt-6">
                        {{ $questions->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>