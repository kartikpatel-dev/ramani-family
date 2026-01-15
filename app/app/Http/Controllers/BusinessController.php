<?php
namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Family;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $businesses = Business::with('family')->latest()->paginate(10);
        return view('businesses.index', compact('businesses'));
    }

    public function create()
    {
        $families = Family::orderBy('family_name')->get();
        return view('businesses.create', compact('families'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'family_id'     => 'required|exists:families,id',
            'business_name' => 'required|string|max:255',
            'type'          => 'nullable|string|max:255',
            'gst_number'    => 'nullable|string|max:50',
            'phone'         => 'nullable|string|max:20',
            'email'         => 'nullable|email|max:255',
            'address'       => 'nullable|string',
        ]);

        Business::create($data);

        return redirect()->route('businesses.index')
            ->with('success', 'Business created successfully.');
    }

    public function edit(Business $business)
    {
        $families = Family::orderBy('family_name')->get();
        return view('businesses.edit', compact('business', 'families'));
    }

    public function update(Request $request, Business $business)
    {
        $data = $request->validate([
            'family_id'     => 'required|exists:families,id',
            'business_name' => 'required|string|max:255',
            'type'          => 'nullable|string|max:255',
            'gst_number'    => 'nullable|string|max:50',
            'phone'         => 'nullable|string|max:20',
            'email'         => 'nullable|email|max:255',
            'address'       => 'nullable|string',
        ]);

        $business->update($data);

        return redirect()->route('businesses.index')
            ->with('success', 'Business updated successfully.');
    }

    public function destroy(Business $business)
    {
        $business->delete();

        return redirect()->route('businesses.index')
            ->with('success', 'Business deleted successfully.');
    }
}
