<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;
use Auth;
use JWTAuth;
use DB;
use Session;
use App\Traits\DocumentTrait;
use Exception;
use Illuminate\Support\Carbon;

class CampaignController extends Controller
{
    use DocumentTrait;
    public function createOrUpdateCampaign(Request $request, int $campaign = 0)
    {
        try { 
            $validationRules = [
                'campaign_name' => 'required|string|between:2,200',
                'advertiser' => 'required|string|between:2,200',
                'category' => 'required|string|between:1,200',
                'street_address' => 'nullable|string',
                'country_id' => 'nullable|numeric',
                'country_name' => 'nullable|string',
                'state_id' => 'nullable|numeric',
                'state_name' => 'nullable|string',
                'provience_id' => 'required|numeric',
                'provience_name' => 'required|string',
                'city_id' => 'nullable|numeric',
                'city_name' => 'nullable|string',
                'suburb_id' => 'nullable|numeric',
                'suburb_name' => 'nullable|string',
                'latitude' => 'nullable|string',
                'longitude' => 'nullable|string',
                'start_date' => 'required|date_format:Y-m-d',
                'end_date' => 'required|required_with:start_date|date_format:Y-m-d|after:start_date',
                'brands' => 'required|array',
                'brands.id' => 'nullable|string|exists:brands,id',
                'brands.*.name' => 'required|string',
                'image' => 'nullable|numeric|exists:documents,id'
            ];
            
            $validator = Validator::make(array_merge($request->all(), $request->route()->parameters()), $validationRules);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();
            $createCampaign = [
                'campaign_name' => isset($requestArr['campaign_name']) ? $requestArr['campaign_name'] : null,
                'advertiser' => isset($requestArr['advertiser']) ? $requestArr['advertiser'] : null,
                'category' => isset($requestArr['category']) ? $requestArr['category'] : null,
                'street_address' => isset($requestArr['street_address']) ? $requestArr['street_address'] : null,
                'country_id' => isset($requestArr['country_id']) ? $requestArr['country_id'] : null,
                'country_name' => isset($requestArr['country_name']) ? $requestArr['country_name'] : null,
                'state_id' => isset($requestArr['state_id']) ? $requestArr['state_id'] : null,
                'state_name' => isset($requestArr['state_name']['id']) ? $requestArr['state_name']['id'] : 0,
                'provience_id' => isset($requestArr['provience_id']) ? $requestArr['provience_id'] : null,
                'provience_name' => isset($requestArr['provience_name']) ? $requestArr['provience_name'] : null,
                'city_id' => isset($requestArr['city_id']) ? $requestArr['city_id'] : null,
                'city_name' => isset($requestArr['city_name']) ? $requestArr['city_name'] : null,
                'suburb_id' => isset($requestArr['suburb_id']) ? $requestArr['suburb_id'] : null,
                'suburb_name' => isset($requestArr['suburb_name']['id']) ? $requestArr['suburb_name']['id'] : null,
                'latitude' => isset($requestArr['latitude']) ? $requestArr['latitude'] : null,
                'longitude' => isset($requestArr['longitude']) ? $requestArr['longitude'] : null,
                'start_date' => isset($requestArr['start_date']) ? $requestArr['start_date'] : null,
                'end_date' => isset($requestArr['end_date']) ? $requestArr['end_date'] : null,
            ];
            DB::beginTransaction();
            $statusCode = 201;
            $statusText = "Created";
            if ($campaign > 0) {
                $statusCode = 200;
                $statusText = "Updated";
                $dbQuery = Campaign::where('id', $campaign);
                $campaignArr = $dbQuery->firstOrFail();
                $preData = $campaignArr->toArray();
                $createCampaign['updated_by'] = (int)$request->session()->get('user_id');
                $createCampaign['updated_at'] = now();
                $campaignArr->update($createCampaign);
            } else {
                $createCampaign['status'] = 1;
                $createCampaign['barcode'] = $this->generateUniqueBarcode(new Campaign, 1);
                $createCampaign['added_by'] = (int)$request->session()->get('user_id');
                $createCampaign['added_at'] = now();
                $campaignArr = Campaign::create($createCampaign);
            }
            if (isset($requestArr['brands']) && count($requestArr['brands']) > 0) {
                foreach($requestArr['brands'] as $brand)
                {
                    $brandArr = [
                        'name' => isset($brand['name']) ? $brand['name'] : null,
                        'campaign_id' => $campaignArr->id,
                    ];
                    if(isset($brand['id']) && $brand['id'] > 0)
                    {
                        $dbQuery = Brand::where('id', $campaign);
                        $brand = $dbQuery->firstOrFail();
                        $brandArr['updated_by'] = (int)$request->session()->get('user_id');
                        $brandArr['updated_at'] = now();
                        $brand->update($brandArr);
                    }
                    else
                    {
                        $brandArr['status'] = 1;
                        $brandArr['added_by'] = (int)$request->session()->get('user_id');
                        $brandArr['added_at'] = now();
                        $brand = Brand::create($brandArr);
                    }
                }
            }

            if (isset($requestArr['image']) && (int)$requestArr['image'] > 0) {
                $this->documentUpdate($requestArr['image'], 2, $campaignArr->id, (int)$request->session()->get('user_id'));
            }
            DB::commit();
            return $this->success($campaignArr, "Campaign {$statusText} Successfully.", $statusCode, true);
        } catch (ModelNotFoundException $err) {
           DB::rollBack();
            return $this->error("Customer Not Found", 404);
        } catch (Exception $err) {
            DB::rollBack();
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }

    public function createOrUpdateBrand(Request $request, int $brand = 0)
    {
        try {
            $validationRules = [
                'name' => 'required|string|between:2,200',
                'campaign_id' => 'required|numeric|exists:campaigns,id',
            ];
            
            $validator = Validator::make(array_merge($request->all(), $request->route()->parameters()), $validationRules);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();
            
            DB::beginTransaction();
            $statusCode = 201;
            $statusText = "Created";
            if ($brand > 0) {
                $statusCode = 200;
                $statusText = "Updated";
                $dbQuery = Brand::where('id', $brand);
                $brandArr = $dbQuery->firstOrFail();
                $createBrand['updated_by'] = (int)$request->session()->get('user_id');
                $createBrand['updated_at'] = now();
                $brandArr->update($createBrand);
            } else {
                $createBrand['status'] = 1;
                $createBrand['added_by'] = (int)$request->session()->get('user_id');
                $createBrand['added_at'] = now();
                $brandArr = Brand::create($createBrand);
            }
            DB::commit();
            return $this->success($brandArr, "Brand {$statusText} Successfully.", $statusCode, true);
        } catch (ModelNotFoundException $err) {
           DB::rollBack();
            return $this->error("Customer Not Found", 404);
        } catch (Exception $err) {
            DB::rollBack();
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }

    public function getCampaign(Request $request)
    {
        try {
            $rules = [
                'campaign' => 'required|integer|exists:campaigns,id'
            ];
            $validator = Validator::make($request->route()->parameters(), $rules);
            if ($validator->fails()) {
                return $this->success($validator->errors(), "Validation Error", 422);
            }
            $userArr = Auth::user();
            $campaignData = Campaign::where('id', $request['campaign'])->with(['campaignBillboards', 'campaignBillboards.billboard'])->first();
            return $this->success($campaignData, "Campaign Data.", 200);
        } catch (ModelNotFoundException $err) {
            return $this->error("Billboard Not Found", 404);
        } catch (Exception $err) {
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }
    
    public function getCampaigns(Request $request)
    {
        try {

            $billboardObject = new Campaign;

            $validationRules = [
                'per_page' => 'nullable|numeric',
                'current_page' => 'nullable|numeric',
                'sort_column' => 'nullable|string|in:' . implode(',', $billboardObject->getSortable()),
                'sort_order' => 'nullable|string|in:asc,desc',
                'status' => 'nullable|string|in:all,active,inactive',
                'search' => 'nullable|string|between:1,100',
            ];

            foreach ($billboardObject->getSearchable() as $search) {
                $validationRules[$search['validation']] = 'nullable|string|between:1,100';
            }

            $validator = Validator::make($request->all(), $validationRules);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $requestArr = $validator->validated();

            $per_page = !empty($requestArr['per_page']) ? (int)$requestArr['per_page'] : (int)env('PAGE_LIMIT', 15);

            $current_page = !empty($requestArr['current_page']) ? (int)$requestArr['current_page'] : 1;

            $search = isset($requestArr['search']) ? $requestArr['search'] : null;
            
            $sort_column = !empty($requestArr['sort_column']) ? $requestArr['sort_column'] : 'id';

            $sort_order = !empty($requestArr['sort_order']) ? $requestArr['sort_order'] : 'desc';

            $status = isset($requestArr['status']) ? $requestArr['status'] : 'all';
            $userArr = Auth::user();
            $dbQuery = Campaign::where('added_by', (int)$userArr->id);
            
            if (!empty($search)) {
                $dbQuery->search($search);
            } else {
                foreach ($billboardObject->getSearchable() as $search) {
                    $filterArray = explode('.', $search['validation']);
                    $dbKey = isset($filterArray[0]) ? $filterArray[0] : null;
                    $searchKey = isset($filterArray[1]) ? $filterArray[1] : null;
                    if (isset($request[$dbKey]) && is_string($request[$dbKey])) {
                        if (in_array($dbKey, $billboardObject->getEncryptable())) {
                            $dbQuery->whereEncrypted($dbKey, 'like', '%' . $request[$dbKey] . '%');
                        } else {
                            $dbQuery->where($dbKey, 'like', '%' . $request[$dbKey] . '%');
                        }
                    }
                }
            }
            
            switch ($status) {
                case 'active':
                    $dbQuery->where('status', 1);
                    break;
                case 'inactive':
                    $dbQuery->where('status', 0);
                    break;
            }
            $dbQuery->with(['added_by', 'updated_by']);
            
            $totalBillboards = $dbQuery->count();
            $offset = ($current_page * $per_page) - $per_page;
            $billboardArr = $dbQuery->orderBy($sort_column, $sort_order)
                ->skip($offset)
                ->take($per_page)
                ->get()
                ->append(['created_at', 'modified_at']);


            $resultArr = [
                'current_page' => $current_page,
                'rows' => $billboardArr,
                'offset' => $offset,
                'per_page' => $per_page,
                'total_rows' => $totalBillboards
            ];

            return $this->success($resultArr, 'Campaign(s) Retrieved Successfully.');

        } catch (Exception $err) {
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }
}
