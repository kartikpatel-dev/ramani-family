<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Get full profile
    // public function profile(Request $request)
    // {
    //     return response()->json([
    //         'status' => true,
    //         'data' => $request->user()
    //     ]);
    // }

    public function profile(Request $request)
    {
        $user = $request->user()->load(['state','district','subDistrict']);

        return response()->json([
            'status' => true,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,

                'state' => [
                    'id' => $user->state->id ?? null,
                    'name' => $user->state->name ?? null,
                ],
                'district' => [
                    'id' => $user->district->id ?? null,
                    'name' => $user->district->name ?? null,
                ],
                'sub_district' => [
                    'id' => $user->subDistrict->id ?? null,
                    'name' => $user->subDistrict->name ?? null,
                ],

                'village' => $user->village,
                'mobile' => $user->mobile,
                'marital_status' => $user->marital_status,
                'blood_group' => $user->blood_group,
            ]
        ]);
    }

    // ✅ Personal detail
    public function updatePersonal(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'surname' => 'required',
            // 'district' => 'required',
            // 'taluka' => 'required',
            'state_id' => 'required|exists:states,id',
            'district_id' => 'required|exists:districts,id',
            'sub_district_id' => 'required|exists:sub_districts,id',
            'village' => 'required',
            'address' => 'nullable',
            'dob' => 'nullable|date',
            'gender' => 'nullable',
        ]);

        $user = $request->user();
        $user->update($data + [
            'name' => $data['first_name'].' '.$data['surname']
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Personal detail updated',
            'data' => $user
        ]);
    }

    // ✅ Business detail
    public function updateBusiness(Request $request)
    {
        $data = $request->validate([
            'business_name' => 'nullable|string|max:255',
            'business_address' => 'nullable|string',
            'business_contact' => 'nullable|string|max:20',
            'show_number' => 'required|boolean',
            'other_detail' => 'nullable|string',
        ]);

        $user = $request->user();
        $user->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Business detail updated',
            'data' => $user
        ]);
    }

    // ✅ Marital detail
    public function updateMarital(Request $request)
    {
        $data = $request->validate([
            'height' => 'nullable|string|max:20',
            'weight' => 'nullable|string|max:20',
            'zodiac' => 'nullable|string|max:50',
            'education' => 'nullable|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'brother' => 'nullable|integer',
            'sister' => 'nullable|integer',
            'maternal_detail' => 'nullable|string',
            'property_detail' => 'nullable|string',
            'marital_status' => 'nullable|string',
        ]);

        $user = $request->user();
        $user->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Marital detail updated',
            'data' => $user
        ]);
    }
}

