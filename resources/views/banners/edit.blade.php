<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl">Edit Banner</h2>
</x-slot>

<div class="py-6 max-w-xl mx-auto">
<form method="POST" action="{{ route('banners.update',$banner) }}" enctype="multipart/form-data">
@csrf @method('PUT')

<input name="title" value="{{ $banner->title }}"
 class="w-full mb-3 border p-2">

<img src="{{ $banner->image }}" class="h-24 mb-3">

<input type="file" name="image" class="mb-3">

<select name="status" class="w-full mb-3 border p-2">
    <option value="1" @selected($banner->status)>Active</option>
    <option value="0" @selected(!$banner->status)>Inactive</option>
</select>

<button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
</form>
</div>
</x-app-layout>
