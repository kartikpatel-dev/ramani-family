<?php
namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $families = Family::latest()->paginate(10);
        return view('families.index', compact('families'));
    }

    public function create()
    {
        return view('families.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'family_name' => 'required|string|max:255',
            'head_name'   => 'nullable|string|max:255',
            'phone'       => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:255',
            'address'     => 'nullable|string',
        ]);

        Family::create($data);

        return redirect()->route('families.index')
            ->with('success', 'Family created successfully.');
    }

    public function show(Family $family)
    {
        $family->load('businesses');
        return view('families.show', compact('family'));
    }

    public function edit(Family $family)
    {
        return view('families.edit', compact('family'));
    }

    public function update(Request $request, Family $family)
    {
        $data = $request->validate([
            'family_name' => 'required|string|max:255',
            'head_name'   => 'nullable|string|max:255',
            'phone'       => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:255',
            'address'     => 'nullable|string',
        ]);

        $family->update($data);

        return redirect()->route('families.index')
            ->with('success', 'Family updated successfully.');
    }

    public function destroy(Family $family)
    {
        $family->delete();

        return redirect()->route('families.index')
            ->with('success', 'Family deleted successfully.');
    }
}
