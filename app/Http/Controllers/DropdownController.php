<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DropdownController extends Controller
{
    public function index(): View
    {
        $data['countries'] = Country::get(["name", "id"]);
        return view('dropdown', $data);
    }


    public function fetchState(Request $request): JsonResponse
    {
        $data['states'] = State::where("country_id", $request->country_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }


    public function fetchCity(Request $request): JsonResponse
    {
        $data['cities'] = City::where("state_id", $request->state_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }

}
