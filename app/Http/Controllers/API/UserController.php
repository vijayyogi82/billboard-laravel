<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Auth;
use JWTAuth;
use Session;
use Exception;
use App\Traits\DocumentTrait;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    use DocumentTrait;
    public function validateMobileOrEmail(Request $request)
    {
        //print_r(User::all()->toArray()); die;
        try {
            $customMessages = [
                'required' => 'The :attribute field is required.',
                'exists_encrypted' => 'The :attribute is invalid.'
            ];
            $validator = Validator::make($request->all(), [
                'phone' => 'required_without:email|string|max:100|exists_encrypted:users,phone',
                'email' => 'required_without:phone|string|max:100|exists:users,email',
            ], $customMessages);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();
            $dbQuery = User::query();
            if(isset($requestArr['phone']))
            {
                $dbQuery->whereEncrypted('phone', $requestArr['phone']);
                $errorText = "Phone Number";
            }
            else
            {
                $dbQuery->where('email', $requestArr['email']);
                $errorText = "Email Id";
            }

            $UserDetails = $dbQuery->first();

            if(!$UserDetails)
            {
                return $this->error('Incorrect '.$errorText.'. Please try again.', 422);
            }
            $otp = mt_rand(100000,999999); 
            $UserDetails->otp = $otp;
            Session::put('login_otp', $otp);

            return $this->success($UserDetails, "User Validated Successfully.", 200);
        } catch (Exception $err) {
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        try {
            
            $customMessages = [
                'required' => 'The :attribute field is required.',
            ];
            $validator = Validator::make($request->all(), [
                'phone' => 'required_without:email|string|max:100|exists_encrypted:users,phone',
                'email' => 'required_without:phone|string|max:100|exists:users,email',
                'otp' => 'required:phone|numeric',
            ], $customMessages);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();
            $dbQuery = User::query();
            if(isset($requestArr['phone']))
            {
                $dbQuery->whereEncrypted('phone', $requestArr['phone']);
                $errorText = "Phone Number";
            }
            else
            {
                $dbQuery->where('email', $requestArr['email']);
                $errorText = "Email Id";
            }

            $UserDetails = $dbQuery->first();

            if(!$UserDetails)
            {
                return $this->error('Incorrect '.$errorText.'. Please try again.', 422);
            }
            $otp = Session::get('login_otp');
            if($otp != $requestArr['otp'])
            {
                return $this->error('Invalid Otp. Please try again.', 422);
            }
            $userToken=JWTAuth::fromUser($UserDetails);
            if (!$userToken) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }

            $result = [
                'access_token' => $userToken,
                'user' => $UserDetails,
            ];

            return $this->success($result, "User Logged In Successfully", 200);
        } catch (Exception $err) {
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }

    public function registerUser(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => "required|string",
                'role_id' => 'required|numeric|exists:role,id',
                'role_name' => 'required|string',
                'register_name' => 'required|string',
                'vat_gst_number' => 'required|string|unique_encrypted:users,vat_gst_number',
                'building_name' => 'nullable|string',
                'building_number' => 'nullable|string',
                'street_name' => 'nullable|string',
                'city_id' => 'nullable|numeric|exists:cities,id',
                'state_id' => 'nullable|numeric|exists:states,id',
                'country_id' => 'nullable|numeric|exists:countries,id',
                'postal_code' => 'nullable|string',
                'po_box' => 'nullable|string',
                'alt_city' => 'nullable|string',
                'alt_state' => 'nullable|string',
                'alt_country' => 'nullable|string',
                'alt_postal_code' => 'nullable|string',
                'country_code' => 'nullable|string',
                'city_code' => 'nullable|string',
                'teliphone_number' => 'nullable|string',
                'contact_person' => 'nullable|string',
                'phone' => 'required|string|max:100|unique_encrypted:users,phone',
                'email' => 'required|email:rfc|string|max:100|unique_encrypted:users,email',
                'alternate_contact_person' => 'nullable|string',
                'alternate_phone' => 'nullable|string',
                'alternate_email' => 'nullable|email:rfc|string',
                'name_of_company' => 'required|string',
                'street_address' => 'required|string'
            ], [
                "unique_encrypted" => "The :attribute Already Exists"
            ]);
            
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();
            
            $createdArray = [
                "name" => isset($requestArr['name']) ? $requestArr['name'] : null,
                "email" => isset($requestArr['email']) ? $requestArr['email'] : null, 
                "password" => bcrypt('admin@123'),
                "phone" => isset($requestArr['phone']) ? $requestArr['phone'] : null,
                "contact_person" => isset($requestArr['contact_person']) ? $requestArr['contact_person'] : null,
                "alternate_email" => isset($requestArr['alternate_email']) ? $requestArr['alternate_email'] : null,
                "alternate_phone" => isset($requestArr['alternate_phone']) ? $requestArr['alternate_phone'] : null,
                "role_id" => isset($requestArr['role_id']) ? $requestArr['role_id'] : null,
                "role_name" => isset($requestArr['role_name']) ? $requestArr['role_name'] : null,
                "name_of_company" => isset($requestArr['name_of_company']) ? $requestArr['name_of_company'] : null,
                "register_name" => isset($requestArr['register_name']) ? $requestArr['register_name'] : null,
                "vat_gst_number" => isset($requestArr['vat_gst_number']) ? $requestArr['vat_gst_number'] : null,
                "building_number" => isset($requestArr['building_number']) ? $requestArr['building_number'] : null,
                "building_name" => isset($requestArr['building_name']) ? $requestArr['building_name'] : null,
                "street_address" => isset($requestArr['street_address']) ? $requestArr['street_address'] : null,
                "city_id" => isset($requestArr['city_id']) ? $requestArr['city_id'] : null,
                "state_id" => isset($requestArr['state_id']) ? $requestArr['state_id'] : null,
                "country_id" => isset($requestArr['country_id']) ? $requestArr['country_id'] : null,
                "postal_code" => isset($requestArr['postal_code']) ? $requestArr['postal_code'] : null,
                "po_box" => isset($requestArr['po_box']) ? $requestArr['po_box'] : null,
                "alt_city" => isset($requestArr['alt_city']) ? $requestArr['alt_city'] : null,
                "alt_state" => isset($requestArr['alt_state']) ? $requestArr['alt_state'] : null,
                "alt_country" => isset($requestArr['alt_country']) ? $requestArr['alt_country'] : null,
                "alt_postal_code" => isset($requestArr['alt_postal_code']) ? $requestArr['alt_postal_code'] : null,
                "country_code" => isset($requestArr['country_code']) ? $requestArr['country_code'] : null,
                "city_code" => isset($requestArr['city_code']) ? $requestArr['city_code'] : null,
                "teliphone_number" => isset($requestArr['teliphone_number']) ? $requestArr['teliphone_number'] : null,
                "activated" => true,
                "added_by" => 0,
                "added_at" => now(),
            ];



            $user = User::create($createdArray);

            return $this->success($user, "User Registered Successfully", 200);
        } catch (Exception $err) {
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }

    public function sendOtp(Request $request)
    {   
        try {
            $customMessages = [
                'required' => 'The :attribute field is required.',
                'exists_encrypted' => 'The :attribute is invalid.',
            ];
            $validator = Validator::make($request->all(), [
                'phone' => 'required_without:email|string|max:100|exists_encrypted:users,phone',
                'email' => 'required_without:phone|string|max:100|exists:users,email',
            ], $customMessages);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();
            $dbQuery = User::query();
            if(isset($requestArr['phone']))
            {
                $dbQuery->whereEncrypted('phone', $requestArr['phone']);
                $errorText = "Phone Number";
            }
            else
            {
                $dbQuery->where('email', $requestArr['email']);
                $errorText = "Email Id";
            }

            $UserDetails = $dbQuery->first();

            if(!$UserDetails)
            {
                return $this->error('Incorrect '.$errorText.'. Please try again.', 422);
            }
            $otp = mt_rand(100000,999999); 
            Session::put('otp_user_verify', $otp);
            return $this->success($otp, "User Validated Successfully.", 200);
        } catch (Exception $err) {
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }

    public function verifyUserOtp(Request $request)
    {
        try {
            $customMessages = [
                'required' => 'The :attribute field is required.',
            ];
            $validator = Validator::make($request->all(), [
                'phone' => 'required_without:email|string|max:100|exists_encrypted:users,phone',
                'email' => 'required_without:phone|string|max:100|exists:users,email',
                'otp' => 'required:phone|numeric',
            ], $customMessages);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();
            $dbQuery = User::query();
            if(isset($requestArr['phone']))
            {
                $dbQuery->whereEncrypted('phone', $requestArr['phone']);
                $errorText = "Phone Number";
            }
            else
            {
                $dbQuery->where('email', $requestArr['email']);
                $errorText = "Email Id";
            }

            $UserDetails = $dbQuery->first();

            if(!$UserDetails)
            {
                return $this->error('Incorrect '.$errorText.'. Please try again.', 422);
            }
            $otp = Session::get('otp_user_verify');
            if($otp != $requestArr['otp'])
            {
                return $this->error('Invalid Otp. Please try again.', 422);
            }
            $UserDetails->update([
                "is_verified" => true,
                "verified_at" => now()
            ]);
            return $this->success($UserDetails, "User Verified Successfully.", 200);
        } catch (Exception $err) {
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }

    public function UserProfile(Request $request)
    {
        try {
            $customMessages = [
                'required' => 'The :attribute field is required.',
            ];
            $validator = Validator::make(array_merge($request->all(), $request->route()->parameters()), [
                'user' => "required|string|exists:users,id",
                'name' => "required|string",
                'register_name' => 'required|string',
                'vat_gst_number' => 'required|string|unique_encrypted:users,vat_gst_number',
                'building_name' => 'nullable|string',
                'building_number' => 'nullable|string',
                'street_name' => 'nullable|string',
                'city_id' => 'nullable|numeric',
                'state_id' => 'nullable|numeric',
                'country_id' => 'nullable|numeric',
                'postal_code' => 'nullable|string',
                'po_box' => 'nullable|string',
                'alt_city' => 'nullable|string',
                'alt_state' => 'nullable|string',
                'alt_country' => 'nullable|string',
                'alt_postal_code' => 'nullable|string',
                'country_code' => 'nullable|string',
                'city_code' => 'nullable|string',
                'teliphone_number' => 'nullable|string',
                'contact_person' => 'nullable|string',
                'phone' => 'required|string|max:100|unique_encrypted:users,phone',
                'email' => 'required|email:rfc|string|max:100|unique_encrypted:users,email',
                'alternate_contact_person' => 'nullable|string',
                'alternate_phone' => 'nullable|string',
                'alternate_email' => 'nullable|email:rfc|string',
                'name_of_company' => 'required|string',
                'street_address' => 'required|string',
                'profile_logo' => 'nullable|numeric|exists:documents,id'
            ], $customMessages);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();

            $updatedArray = [
                "name" => isset($requestArr['name']) ? $requestArr['name'] : null,
                "email" => isset($requestArr['email']) ? $requestArr['email'] : null, 
                "password" => bcrypt('admin@123'),
                "phone" => isset($requestArr['phone']) ? $requestArr['phone'] : null,
                "contact_person" => isset($requestArr['contact_person']) ? $requestArr['contact_person'] : null,
                "alternate_email" => isset($requestArr['alternate_email']) ? $requestArr['alternate_email'] : null,
                "alternate_phone" => isset($requestArr['alternate_phone']) ? $requestArr['alternate_phone'] : null,
                "role_id" => isset($requestArr['role_id']) ? $requestArr['role_id'] : null,
                "role_name" => isset($requestArr['role_name']) ? $requestArr['role_name'] : null,
                "name_of_company" => isset($requestArr['name_of_company']) ? $requestArr['name_of_company'] : null,
                "register_name" => isset($requestArr['register_name']) ? $requestArr['register_name'] : null,
                "vat_gst_number" => isset($requestArr['vat_gst_number']) ? $requestArr['vat_gst_number'] : null,
                "building_number" => isset($requestArr['building_number']) ? $requestArr['building_number'] : null,
                "building_name" => isset($requestArr['building_name']) ? $requestArr['building_name'] : null,
                "street_address" => isset($requestArr['street_address']) ? $requestArr['street_address'] : null,
                "city_id" => isset($requestArr['city_id']) ? $requestArr['city_id'] : null,
                "state_id" => isset($requestArr['state_id']) ? $requestArr['state_id'] : null,
                "country_id" => isset($requestArr['country_id']) ? $requestArr['country_id'] : null,
                "postal_code" => isset($requestArr['postal_code']) ? $requestArr['postal_code'] : null,
                "po_box" => isset($requestArr['po_box']) ? $requestArr['po_box'] : null,
                "alt_city" => isset($requestArr['alt_city']) ? $requestArr['alt_city'] : null,
                "alt_state" => isset($requestArr['alt_state']) ? $requestArr['alt_state'] : null,
                "alt_country" => isset($requestArr['alt_country']) ? $requestArr['alt_country'] : null,
                "alt_postal_code" => isset($requestArr['alt_postal_code']) ? $requestArr['alt_postal_code'] : null,
                "country_code" => isset($requestArr['country_code']) ? $requestArr['country_code'] : null,
                "city_code" => isset($requestArr['city_code']) ? $requestArr['city_code'] : null,
                "teliphone_number" => isset($requestArr['teliphone_number']) ? $requestArr['teliphone_number'] : null,
                "activated" => true,
                "updated_by" => (int)$request->session()->get('user_id'),
                "updated_at" => now(),
            ];

            $user = User::where('id', $requestArr['user'])->first();

            $user->update($updatedArray);

            if (isset($requestArr['profile_logo']) && (int)$requestArr['profile_logo'] > 0) {
                $this->documentUpdate($requestArr['profile_logo'], 1, $user->id, (int)$request->session()->get('user_id'));
            }
            
            return $this->success($user, "User Verified Successfully.", 200);
        } catch (Exception $err) {
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }

    public function getUserProfile(Request $request)
    {
        try {
            $validator = Validator::make(array_merge($request->all(), $request->route()->parameters()), [
                'user' => "required|string|exists:users,id"
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();

            $user = User::where('id', $requestArr['user'])->first();
            return $this->success($user, "User Retrived Successfully.", 200);
        } catch (Exception $err) {
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }

    public function AddToWishList(Request $request)
    {
        try {
            $validator = Validator::make(array_merge($request->all(), $request->route()->parameters()), [
                'user_id' => "required|string|exists:users,id",
                'type' => "required|numeric",
                'type_id' => 'required|numeric',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();
            $userArr = Auth::user();
            $createdArray = [
                "user_id" => isset($requestArr['user_id']) ? $requestArr['user_id'] : 0,
                "type" => isset($requestArr['type']) ? $requestArr['type'] : 0, 
                "type_id" => isset($requestArr['type_id']) ? $requestArr['type_id'] : 0,
                "added_by" => $userArr->id,
                "added_at" => now(),
            ];

            $user = WishList::cerated($createdArray);
            return $this->success($user, "Added to wishlist.", 200);
        } catch (Exception $err) {
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }

    public function RemoveWishList(Request $request)
    {
        try {
            $validator = Validator::make(array_merge($request->all(), $request->route()->parameters()), [
                'wishlist_id' => "required|string|exists:wish_lists,id"
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();
            WishList::where('id', $requestArr['wishlist_id'])->delete();
            return $this->success([], "Remove from wishlist.", 200);
        } catch (Exception $err) {
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }

    public function getWishLists(Request $request)
    {
        try {
            $validator = Validator::make(array_merge($request->all(), $request->route()->parameters()), [
                'per_page' => 'nullable|numeric',
                'current_page' => 'nullable|numeric',
                'sort_column' => 'nullable|string|in:' . implode(',', $billboardObject->getSortable()),
                'sort_order' => 'nullable|string|in:asc,desc',
                'type' => 'required|string|in:all,campaign,billboard',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();
            $requestArr = $validator->validated();

            $per_page = !empty($requestArr['per_page']) ? (int)$requestArr['per_page'] : (int)env('PAGE_LIMIT', 15);

            $current_page = !empty($requestArr['current_page']) ? (int)$requestArr['current_page'] : 1;

            $dbQuery = WishList::with(['campaign', 'billboard'])->where('added_by', (int)$request->session()->get('user_id'));

            switch ($status) {
                case 'campaign':
                    $dbQuery->where('type', 1);
                    break;
                case 'billboard':
                    $dbQuery->where('type', 2);
                    break;
            }
            $totalBillboards = $dbQuery->count();
            $offset = ($current_page * $per_page) - $per_page;
            $billboardArr = $dbQuery->orderBy($sort_column, $sort_order)
                ->skip($offset)
                ->take($per_page)
                ->get();

            $resultArr = [
                'current_page' => $current_page,
                'rows' => $billboardArr,
                'offset' => $offset,
                'per_page' => $per_page,
                'total_rows' => $totalBillboards
            ];
            return $this->success($resultArr, "Wishlist retrived Successfully.", 200);
        } catch (Exception $err) {
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }
}
