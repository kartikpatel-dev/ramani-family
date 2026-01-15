<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FamilyRegister;
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
            'state_name' => 'required|exists:states,name',
            'district_id' => 'required|exists:districts,id',
            'district_name' => 'required|exists:districts,name',
            'sub_district_id' => 'required|exists:sub_districts,id',
            'sub_district_name' => 'required|exists:sub_districts,name',
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
            'state_name' => $data['state_name'],
            'district_id' => $data['district_id'],
            'district_name' => $data['district_name'],
            'sub_district_id' => $data['sub_district_id'],
            'sub_district_name' => $data['sub_district_name'],
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
        $token = $user->createToken('android-token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user
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

