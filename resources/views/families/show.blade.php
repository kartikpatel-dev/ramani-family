<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight">
                Family Details - {{ $family->family_name }}
            </h2>
            <a href="{{ route('families.index') }}"
               class="px-4 py-2 bg-gray-600 text-white rounded">
                ← Back to Families
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Family Information --}}
            <div class="bg-white shadow rounded p-6 mb-6">
                <h3 class="text-lg font-bold mb-4">Family Information</h3>

                <table class="table-auto text-sm w-full">
                    <tr>
                        <td class="font-bold py-2 w-40">Family Name:</td>
                        <td>{{ $family->family_name }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold py-2">Head Name:</td>
                        <td>{{ $family->head_name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold py-2">Phone:</td>
                        <td>{{ $family->phone ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold py-2">Email:</td>
                        <td>{{ $family->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold py-2">Address:</td>
                        <td>{{ $family->address ?? '-' }}</td>
                    </tr>
                </table>

                <div class="mt-4 flex gap-3">
                    <a href="{{ route('families.edit', $family) }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded">
                        Edit Family
                    </a>

                    <form action="{{ route('families.destroy', $family) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this family?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            {{-- Business List --}}
            <div class="bg-white shadow rounded p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">Business List</h3>
                    <a href="{{ route('businesses.create') }}"
                       class="px-4 py-2 bg-green-600 text-white rounded">
                        + Add Business
                    </a>
                </div>

                @if ($family->businesses->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left">ID</th>
                                    <th class="px-4 py-2 text-left">Business Name</th>
                                    <th class="px-4 py-2 text-left">Type</th>
                                    <th class="px-4 py-2 text-left">Phone</th>
                                    <th class="px-4 py-2 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($family->businesses as $business)
                                    <tr class="border-t">
                                        <td class="px-4 py-2">{{ $business->id }}</td>
                                        <td class="px-4 py-2">{{ $business->business_name }}</td>
                                        <td class="px-4 py-2">{{ $business->type ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $business->phone ?? '-' }}</td>
                                        <td class="px-4 py-2 flex gap-2">
                                            <a href="{{ route('businesses.edit', $business->id) }}"
                                               class="px-3 py-1 text-xs bg-yellow-500 text-white rounded">
                                                Edit
                                            </a>

                                            <form action="{{ route('businesses.destroy', $business->id) }}"
                                                  method="POST"
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-600">No businesses added yet.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
