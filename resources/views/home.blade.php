<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="px-6 pt-6 text-gray-900">
                    <div class="grid grid-cols-4 gap-x-5 gap-y-8">
                        @forelse($activities as $activity)
                            <div>
                                <a href="{{ route('activity.show', $activity) }}">
                                @if ($activity->photo)
                                    <img src="{{ asset($activity->thumbnail) }}" alt="{{ $activity->name }}">
                                @else
                                    <img src="{{ asset('images/no_image.jpg') }}" alt="image not available">
                                @endif
                                <h2>
                                    <a href="#" class="text-lg font-semibold">{{ $activity->name }}</a>
                                </h2>
                                <time>{{ $activity->start_time }}</time>
                                </a>
                            </div>
                        @empty
                            <p>No activities</p>
                        @endforelse
                    </div>

                    <div class="mt-6">{{ $activities->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
