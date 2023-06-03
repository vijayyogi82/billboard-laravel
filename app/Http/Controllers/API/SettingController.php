<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;

class SettingController extends Controller
{
    public function getRoles(Request $request)
    {
        try {

            $roleData = Role::all();

            return $this->success($roleData, "Roles Retrived Successfully", 200);
        } catch (Exception $err) {
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }

    public function getCountries(Request $request)
    {
        try {

            $countryData = Country::all();

            return $this->success($countryData, "Countries Retrived Successfully", 200);
        } catch (Exception $err) {
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }

    public function getStates(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'country' => "nullable|numeric|exists:countries,id",
            ]);
            
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();

            $dbQuery = State::query();
            if(isset($requestArr['country']))
            {
                $dbQuery->where('country', $requestArr['country']);
            }

            $result = $dbQuery->get();

            return $this->success($result, "States Retrived Successfully", 200);
        } catch (Exception $err) {
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }

    public function getCities(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'state' => "nullable|numeric|exists:countries,id",
            ]);
            
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();

            $dbQuery = City::query();
            if(isset($requestArr['state']))
            {
                $dbQuery->where('state', $requestArr['state']);
            }

            $result = $dbQuery->get();

            return $this->success($result, "States Retrived Successfully", 200);
        } catch (Exception $err) {
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }
}
