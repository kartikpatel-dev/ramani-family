<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl">Add Banner</h2>
</x-slot>

<div class="py-6 max-w-xl mx-auto">
<form method="POST" action="{{ route('banners.store') }}" enctype="multipart/form-data">
@csrf

<input name="title" class="w-full mb-3 border p-2" placeholder="Title">

<input type="file" name="image" class="mb-3" required>

<select name="status" class="w-full mb-3 border p-2">
    <option value="1">Active</option>
    <option value="0">Inactive</option>
</select>

<button class="px-4 py-2 bg-green-600 text-white rounded">Save</button>
</form>
</div>
</x-app-layout>
