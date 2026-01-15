<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl">Banners</h2>
            <a href="{{ route('banners.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded">
                + Add Banner
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto">
        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white shadow rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Image</th>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banners as $banner)
                <tr class="border-t">
                    <td class="px-4 py-2">
                        <img src="{{ $banner->image }}" class="h-16">
                    </td>
                    <td class="px-4 py-2">{{ $banner->title }}</td>
                    <td class="px-4 py-2">
                        {{ $banner->status ? 'Active' : 'Inactive' }}
                    </td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('banners.edit',$banner) }}"
                           class="text-blue-600">Edit</a>

                        <form method="POST" action="{{ route('banners.destroy',$banner) }}">
                            @csrf @method('DELETE')
                            <button class="text-red-600"
                              onclick="return confirm('Delete banner?')">
                              Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
