<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight">
                Families
            </h2>
            <a href="{{ route('families.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded">
                + Add Family
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Family Name</th>
                            <th class="px-4 py-2 text-left">Head</th>
                            <th class="px-4 py-2 text-left">Phone</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($families as $family)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $family->id }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('families.show', $family) }}" class="text-blue-600 underline">
                                        {{ $family->family_name }}
                                    </a>
                                </td>
                                <td class="px-4 py-2">{{ $family->head_name }}</td>
                                <td class="px-4 py-2">{{ $family->phone }}</td>
                                <td class="px-4 py-2 flex gap-2">
                                    <a href="{{ route('families.edit', $family) }}"
                                       class="px-3 py-1 text-xs bg-yellow-500 text-white rounded">
                                        Edit
                                    </a>
                                    <form action="{{ route('families.destroy', $family) }}" method="POST"
                                          onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1 text-xs bg-red-600 text-white rounded">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-4 py-4 text-center" colspan="5">
                                    No families found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $families->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
