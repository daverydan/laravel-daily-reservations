<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            {{ __('My Activities') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @session('success')
                        <div class="mb-6 bg-indigo-100 p-4 text-indigo-700">{{ session('success') }}</div>
                    @endsession

                    <div class="grid grid-cols-4 gap-5">
                        @forelse($activities as $activity)
                            <div class="space-y-3">
                                <a href="{{ route('activity.show', $activity) }}">
                                    @if ($activity->photo)
                                        <img src="{{ asset($activity->thumbnail) }}" alt="{{ $activity->name }}">
                                    @else
                                        <img src="{{ asset('images/no_image.jpg') }}" alt="image not available">
                                    @endif
                                    <h2 class="text-lg font-semibold">
                                        {{ $activity->name }}
                                    </h2>
                                    <div><time>{{ $activity->start_time }}</time></div>
                                    <form class="mt-2" action="{{ route('my-activity.destroy', $activity) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button>
                                            Cancel
                                        </x-danger-button>
                                    </form>
                                </a>
                            </div>
                        @empty
                            <p>No activities</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
