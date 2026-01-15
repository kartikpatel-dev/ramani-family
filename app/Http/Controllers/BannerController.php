<?php
namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('banners.index', compact('banners'));
    }

    public function create()
    {
        return view('banners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string',
            'image' => 'required|image',
            'status' => 'required'
        ]);

        $path = $request->file('image')->store('banners','public');

        Banner::create([
            'title' => $data['title'],
            'image' => asset('storage/'.$path),
            'status' => $data['status']
        ]);

        return redirect()->route('banners.index')->with('success','Banner added');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('banners.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $data = $request->validate([
            'title' => 'nullable|string',
            'image' => 'nullable|image',
            'status' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('banners','public');
            $banner->image = asset('storage/'.$path);
        }

        $banner->update($data);

        return redirect()->route('banners.index')->with('success','Banner updated');
    }

    public function destroy($id)
    {
        Banner::findOrFail($id)->delete();
        return redirect()->route('banners.index')->with('success','Banner deleted');
    }
}
