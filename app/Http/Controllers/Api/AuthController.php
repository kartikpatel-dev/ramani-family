<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FamilyRegister;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
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
            'marital_status' => 'required',
            'blood_group' => 'required',
            'mobile' => 'required|unique:family_register,mobile',
            'password' => 'required|min:6',
        ]);

        $user = FamilyRegister::create([
            'name' => $data['first_name'].' '.$data['surname'],
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'] ?? null,
            'surname' => $data['surname'],
            // 'district' => $data['district'],
            // 'taluka' => $data['taluka'],
            'state_id' => $data['state_id'],
            'district_id' => $data['district_id'],
            'sub_district_id' => $data['sub_district_id'],
            'village' => $data['village'],
            'marital_status' => $data['marital_status'],
            'blood_group' => $data['blood_group'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('android-token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Registered successfully',
            'token' => $token,
            'user' => $user
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'mobile' => 'required',
            'password' => 'required',
        ]);

        if (!Auth::attempt([
            'mobile' => $request->mobile,
            'password' => $request->password
        ])) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = Auth::user();

        $user->profile_img = $user->profile_img
        ? asset($user->profile_img)
        : asset('images/profile.jpg');

        $banners = Banner::where('status', 1)
            ->select('id', 'image')
            ->latest()
            ->get();
        $token = $user->createToken('android-token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user,
            'banners' => $banners
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logged out'
        ]);
    }
}

