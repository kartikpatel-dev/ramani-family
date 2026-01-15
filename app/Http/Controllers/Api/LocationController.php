<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\District;
use App\Models\SubDistrict;

class LocationController extends Controller
{
    public function states()
    {
        return response()->json([
            'status' => true,
            'data' => State::select('id','name')->get()
        ]);
    }

    public function districts($state_id)
    {
        return response()->json([
            'status' => true,
            'data' => District::where('state_id', $state_id)
                              ->select('id','name')
                              ->get()
        ]);
    }

    public function subDistricts($district_id)
    {
        return response()->json([
            'status' => true,
            'data' => SubDistrict::where('district_id', $district_id)
                                 ->select('id','name')
                                 ->get()
        ]);
    }
}
