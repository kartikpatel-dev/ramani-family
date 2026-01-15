<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('families.index') }}" class="p-6 bg-white rounded shadow">
                    <h3 class="text-lg font-bold mb-2">Families</h3>
                    <p>Manage families and head details.</p>
                </a>

                <a href="{{ route('businesses.index') }}" class="p-6 bg-white rounded shadow">
                    <h3 class="text-lg font-bold mb-2">Businesses</h3>
                    <p>Manage businesses linked with families.</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
