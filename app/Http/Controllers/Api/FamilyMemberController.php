<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FamilyMember;
use Illuminate\Http\Request;

class FamilyMemberController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'surname' => 'required|string',
            'relation' => 'required|string',
            'gender' => 'required|string',
            'mobile' => 'nullable|string',
            'blood_group' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $member = FamilyMember::create([
            'family_register_id' => $request->user()->id,
            ...$data
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Family member added successfully',
            'data' => $member
        ]);
    }
}
