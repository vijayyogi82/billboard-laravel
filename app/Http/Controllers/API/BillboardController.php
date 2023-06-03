<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 
use App\Models\BillboardDetails;
use App\Models\FlightingService;
use App\Models\Billboard;
use App\Models\PrintingService;
use App\Models\CampaignBillboard;
use App\Traits\DocumentTrait;

class BillboardController extends Controller
{
    use DocumentTrait;
    public function createOrUpdateBillboard(Request $request, int $billboard = 0)
    {
        try {
            $validate_rule = [
                'reference_number' => 'required|string',
                'total_faces' => 'required|numeric',
                'face_labels' => 'required|string',
                'face_registration' => 'required|string',
				'files' => 'nullable|array',
				'files.*' => 'nullable|numeric|exists:documents,id',
            ];

            $validator = Validator::make($request->all(),$validate_rule);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();

            $createBillboard = [
                'reference_number' => isset($requestArr['reference_number']) ? $requestArr['reference_number'] : null,
                'total_faces' => isset($requestArr['total_faces']) ? $requestArr['total_faces'] : 0,
                'face_registration' => isset($requestArr['face_registration']) ? $requestArr['face_registration'] : null,
                'face_labels' => isset($requestArr['face_labels']) ? $requestArr['face_labels'] : null,
            ];

            $userArr = Auth::user();
            DB::beginTransaction();
            $statusCode = 201;
            $statusText = "Created";

            if ($billboard > 0) {
                $statusCode = 200;
                $statusText = "Updated";
                
                $createBillboard['updated_by'] = $userArr->id;
                $createBillboard['updated_at'] = now();
                $billboardArr = Billboard::where('id', $billboard)->first();
                $billboardArr->update($createBillboard);
            } else 
            {
                $createBillboard['status'] = 1;
                $createBillboard['added_by'] = $userArr->id;
                $createBillboard['added_at'] = now();

                $createBillboard['barcode'] = $this->generateUniqueBarcode(new Billboard, 6);
                $billboardArr = Billboard::create($createBillboard);
            }

            if (isset($requestArr['files']) && (int)$requestArr['files'] > 0) {
                $this->documentUpdate($requestArr['files'], 3, $billboardArr->id, (int)$request->session()->get('user_id'));
            }
            DB::commit();
            return $this->success($billboardArr, "Billboard {$statusText} Successfully.", $statusCode, true);
        } catch (ModelNotFoundException $err) {
            DB::rollBack();
            return $this->error("Billboard Not Found", 404);
        } catch (Exception $err) {
            DB::rollBack();
            dd($err);
           return $this->error("Something went wrong. Please try again later.", 500);
        }
    }

	public function createOrUpdateBillboardOld(Request $request, int $billboard = 0)
    {
        try {
            $validate_rule = [
                'owner_ref' => 'required|string',
                'height' => 'required|string',
                'width' => 'required|string',
                'size' => 'required|string',
                'latitude' => 'required|string',
                'longitude' => 'required|string',
                'country' => 'required|string',
                'state' => 'required|string',
                'provience' => 'required|string',
                'city' => 'required|string',
                'suburb' => 'required|string',
                'rate_card' => 'required|string',
                'orintation_id' => 'required|numeric',
                'orintation' => 'required|string',
                'type' => 'required|string',
                'type_id' => 'required|numeric',
                'type_of_display' => 'required|numeric',
                'lanlord_expiry' => 'required|date_format:Y-m-d',
                'available_start_date' => 'required|date_format:Y-m-d',
                'distance_from_road' => 'required|string',
                'readable_distance' => 'required|string',
                'traffic_volume' => 'required|string',
                'printing_size' => 'required_if:type_of_display,1|string',
                'substrate' => 'required_if:type_of_display,1|string',
                'price_30_days' => 'required_if:type_of_display,1|numeric',
                'rope_access' => 'required_if:type_of_display,1|boolean',
                'printing_service' => 'required_if:type_of_display,1|boolean',
                'flighting_service' => 'required_if:type_of_display,1|boolean',
                'flighting_service_arr' => 'required_if:type_of_display,1|array',
                'flighting_service_arr.*.id' => 'nullable|numeric|exists:flighting_services,id',
                'flighting_service_arr.*.service_provider' => 'required_if:flighting_service,true,1|string',
                'flighting_service_arr.*.price' => 'required_if:flighting_service,true,1|numeric',
                'flighting_service_arr.*.rope_access_price' => 'required_if:flighting_service,true,1|numeric',
                'flighting_service_arr.*.substrate' => 'required_if:flighting_service,true,1|string',
                'flighting_service_arr.*.independent' => 'required_if:flighting_service,true,1|boolean',
                'printing_service_arr' => 'required_if:printing_service,true|array',
                'printing_service_arr.*.id' => 'nullable|numeric|exists:printing_services,id',
                'printing_service_arr.*.service_provider' => 'required_if:printing_service,true|string',
                'printing_service_arr.*.price' => 'required_if:printing_service,true|numeric',
                'printing_service_arr.*.substrate' => 'required_if:printing_service,true|string',
                'printing_service_arr.*.independent' => 'required_if:printing_service,true|boolean',
                'format_accepted' => 'required_if:type_of_display,2|string',
                'duration' => 'required_if:type_of_display,2|string',
                'files_naming' => 'required_if:type_of_display,2|numeric',
                'max_size' => 'required_if:type_of_display,2|numeric',
                'bit_rate' => 'required_if:type_of_display,2|string',
                'compression_format' => 'required_if:type_of_display,2|string',
                'submission' => 'required_if:type_of_display,2|string',
                'slot_duration' => 'required_if:type_of_display,2|string',
                'uptime' => 'required_if:type_of_display,2|string',
                'price_per_slot' => 'required_if:type_of_display,2|numeric',
                'min_slot' => 'required_if:type_of_display,2|string',
                'allow_contact' => 'required_if:type_of_display,2|boolean',
            ];

            $validator = Validator::make($request->all(),$validate_rule);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();

            $createBillboardDetails = [
                'owner_ref' => isset($requestArr['owner_ref']) ? $requestArr['owner_ref'] : null,
                'height' => isset($requestArr['height']) ? $requestArr['height'] : null,
                'width' => isset($requestArr['width']) ? $requestArr['width'] : null,
                'size' => isset($requestArr['size']) ? $requestArr['size'] : null,
                'latitude' => isset($requestArr['latitude']) ? $requestArr['latitude'] : null,
                'longitude' => isset($requestArr['longitude']) ? $requestArr['longitude'] : null,
                'country' => isset($requestArr['country']) ? $requestArr['country'] : null,
                'state' => isset($requestArr['state']) ? $requestArr['state'] : null,
                'provience' => isset($requestArr['provience']) ? $requestArr['provience'] : null,
                'city' => isset($requestArr['city']) ? $requestArr['city'] : null,
                'suburb' => isset($requestArr['suburb']) ? $requestArr['suburb'] : null,
                'rate_card' => isset($requestArr['rate_card']) ? $requestArr['rate_card'] : null,
                'orintation_id' => isset($requestArr['orintation_id']) ? $requestArr['orintation_id'] : null,
                'orintation' => isset($requestArr['orintation']) ? $requestArr['orintation'] : null,
                'type' => isset($requestArr['type']) ? $requestArr['type'] : null,
                'type_id' => isset($requestArr['type_id']) ? $requestArr['type_id'] : null,
                'lanlord_expiry' => isset($requestArr['lanlord_expiry']) ? $requestArr['lanlord_expiry'] : null,
                'available_start_date' => isset($requestArr['available_start_date']) ? $requestArr['available_start_date'] : null,
                'distance_from_road' => isset($requestArr['distance_from_road']) ? $requestArr['distance_from_road'] : null,
                'readable_distance' => isset($requestArr['readable_distance']) ? $requestArr['readable_distance'] : null,
                'traffic_volume' => isset($requestArr['traffic_volume']) ? $requestArr['traffic_volume'] : null,
            ];

            $createBillboard = [
                'printing_size' => isset($requestArr['printing_size']) ? $requestArr['printing_size'] : null,
                'substrate' => isset($requestArr['substrate']) ? $requestArr['substrate'] : null,
                'price_30_days' => isset($requestArr['price_30_days']) ? $requestArr['price_30_days'] : null,
                'rope_access' => isset($requestArr['rope_access']) ? $requestArr['rope_access'] : false,
                'printing_service' => isset($requestArr['printing_service']) ? $requestArr['printing_service'] : false,
                'flighting_service' => isset($requestArr['flighting_service']) ? $requestArr['flighting_service'] : false,
                'format_accepted' => isset($requestArr['format_accepted']) ? $requestArr['format_accepted'] : null,
                'duration' => isset($requestArr['duration']) ? $requestArr['duration'] : null,
                'files_naming' => isset($requestArr['files_naming']) ? $requestArr['files_naming'] : null,
                'max_size' => isset($requestArr['max_size']) ? $requestArr['max_size'] : null,
                'bit_rate' => isset($requestArr['bit_rate']) ? $requestArr['bit_rate'] : null,
                'compression_format' => isset($requestArr['compression_format']) ? $requestArr['compression_format'] : null,
                'submission' => isset($requestArr['submission']) ? $requestArr['submission'] : null,
                'slot_duration' => isset($requestArr['slot_duration']) ? $requestArr['slot_duration'] : null,
                'uptime' => isset($requestArr['uptime']) ? $requestArr['uptime'] : null,
                'price_per_slot' => isset($requestArr['price_per_slot']) ? $requestArr['price_per_slot'] : null,
                'min_slot' => isset($requestArr['min_slot']) ? $requestArr['min_slot'] : null,
                'allow_contact'  => isset($requestArr['allow_contact']) ? $requestArr['allow_contact'] : null,
                'billboard_type' => isset($requestArr['type_of_display']) ? $requestArr['type_of_display'] : null,
            ];

            $userArr = Auth::user();
            DB::beginTransaction();
            $statusCode = 201;
            $statusText = "Created";

            if ($billboard > 0) {
                $statusCode = 200;
                $statusText = "Updated";
                
                $createBillboard['updated_by'] = $userArr->id;
                $createBillboard['updated_at'] = now();

                $billboardArr = Billboard::where('id', $billboard)->first();
                $billboardDetailsArr = BillboardDetails::where('billboard', $billboard)->first();

                $billboardArr->update($createBillboard);
                $billboardDetailsArr->update($createBillboardDetails);
            } else 
            {
                $createBillboard['status'] = 1;
                $createBillboard['added_by'] = $userArr->id;
                $createBillboard['added_at'] = now();

                if($requestArr['type_of_display'] == 1)
                {
                    $createBillboard['barcode'] = $this->generateUniqueBarcode(new Billboard, 2);
                }
                else
                {
                    $createBillboard['barcode'] = $this->generateUniqueBarcode(new Billboard, 3);
                }

                $billboardArr = Billboard::create($createBillboard);

                $createBillboardDetails['billboard'] = $billboardArr->id;
                $createBillboardDetails['added_by'] = $userArr->id;
                $createBillboardDetails['added_at'] = now();
                $billboardDetailsArr = BillboardDetails::create($createBillboardDetails);
            }
            if(isset($requestArr['flighting_service_arr']))
            {
                if(!empty($requestArr['flighting_service_arr']))
                {
                    $flighting_service_arr = [];
                    foreach($requestArr['flighting_service_arr'] as $flighting_service)
                    {
                        $flighting_service_arr = [
                            'billboard_id' => $billboardArr->id,
                            'service_provider' => isset($flighting_service['service_provider']) ? $flighting_service['service_provider'] : null,
                            'price' => isset($flighting_service['price']) ? $flighting_service['price'] : 0,
                            'rope_access_price' => isset($flighting_service['rope_access_price']) ? $flighting_service['rope_access_price'] : 0,
                            'substrate' => isset($flighting_service['substrate']) ? $flighting_service['substrate'] : null,
                            'independent' => isset($flighting_service['independent']) ? $flighting_service['independent'] : false,
                        ];
                        if(isset($flighting_service['id']))
                        {
                            $flightingService = FlightingService::where('id', $flighting_service['id'])->first();
                            $flighting_service_arr['updated_at'] = now();
                            $flighting_service_arr['updated_by'] = $userArr->id;
                            $flightingService->update($flighting_service_arr);
                        }
                        else
                        {
                            $flighting_service_arr['barcode'] = $this->generateUniqueBarcode(new FlightingService, 4);
                            $flighting_service_arr['added_at'] = now();
                            $flighting_service_arr['added_by'] = $userArr->id;
                            $flightingService = FlightingService::create($flighting_service_arr);
                        }
                    }
                }
            }

            if(isset($requestArr['printing_service_arr']))
            {
                if(!empty($requestArr['printing_service_arr']))
                {
                    $printing_service_arr = [];
                    foreach($requestArr['printing_service_arr'] as $printing_service)
                    {
                        $printing_service_arr = [
                            "billboard_id" => $billboardArr->id,
                            'service_provider' => isset($printing_service['service_provider']) ? $printing_service['service_provider'] : null,
                            'price' => isset($printing_service['price']) ? $printing_service['price'] : 0,
                            'substrate' => isset($printing_service['substrate']) ? $printing_service['substrate'] : null,
                            'independent' => isset($printing_service['independent']) ? $printing_service['independent'] : false,
                        ];
                        if(isset($printing_service['id']))
                        {
                            $flightingService = PrintingService::where('id', $printing_service['id'])->first();
                            $printing_service_arr['updated_at'] = now();
                            $printing_service_arr['updated_by'] = $userArr->id;
                            $flightingService->update($printing_service_arr);
                        }
                        else
                        {
                            $printing_service_arr['barcode'] = $this->generateUniqueBarcode(new PrintingService, 5);
                            $printing_service_arr['added_at'] = now();
                            $printing_service_arr['added_by'] = $userArr->id;
                            $flightingService = PrintingService::create($printing_service_arr);
                        }
                    }
                }
            }

            if (isset($requestArr['files']) && (int)$requestArr['files'] > 0) {
                $this->documentUpdate($requestArr['files'], 3, $billboardArr->id, (int)$request->session()->get('user_id'));
            }
            DB::commit();
            return $this->success($billboardArr, "Billboard {$statusText} Successfully.", $statusCode, true);
        } catch (ModelNotFoundException $err) {
            DB::rollBack();
            return $this->error("Billboard Not Found", 404);
        } catch (Exception $err) {
            DB::rollBack();
            dd($err);
           return $this->error("Something went wrong. Please try again later.", 500);
        }
    }	
    
    public function getBillboard(Request $request)
    {
        try {
            $rules = [
                'billboard' => 'required|integer|exists:billboards,id'
            ];
            $validator = Validator::make($request->route()->parameters(), $rules);
            if ($validator->fails()) {
                return $this->success($validator->errors(), "Validation Error", 422);
            }
            $userArr = Auth::user();
            $billboardData = Billboard::where('id', $request['billboard'])->with(['printing_services', 'flighting_services', 'billboard_details'])->first();
            return $this->success($billboardData, "Billboard Data.", 200);
        } catch (ModelNotFoundException $err) {
            DB::rollBack();
            return $this->error("Billboard Not Found", 404);
        } catch (Exception $err) {
            DB::rollBack();
            
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }
    
    public function getBillboards(Request $request)
    {
        try {

            $billboardObject = new Billboard;

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
            $alphabate_search = isset($request['alphabate_search']) ? $request['alphabate_search'] : null;

            $sort_column = !empty($requestArr['sort_column']) ? $requestArr['sort_column'] : 'id';

            $sort_order = !empty($requestArr['sort_order']) ? $requestArr['sort_order'] : 'desc';

            $status = isset($requestArr['status']) ? $requestArr['status'] : 'all';

            $dbQuery = Billboard::query();

            /* if ((int)$request->session()->get('channel') === 2) {
                $dbQuery->where('added_by', (int)$request->session()->get('user_id'));
            } */

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
                    $dbQuery->active();
                    break;
                case 'inactive':
                    $dbQuery->inActive();
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

            return $this->success($resultArr, 'Billboard(s) Retrieved Successfully.');

        } catch (Exception $err) {
            dd($err);
            return $this->error("Something went wrong. Please try again later.", 500);
        }
    }

    public function deleteBillboards(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'billboards' => 'required|array',
                'billboards.*' => 'required|numeric|exists:billboards,id'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $requestArr = $validator->validated();

            DB::transaction(function () use ($requestArr) {
                Billboard::whereIn('id', $requestArr['billboards'])->delete();
                FlightingService::whereIn('billboard_id', $requestArr['billboards'])->delete();
                PrintingService::whereIn('billboard_id', $requestArr['billboards'])->delete();
                DigitalBillboard::whereIn('billboard_id', $requestArr['billboards'])->delete();
            }, 5);

            return $this->success([], 'Billboard(s) Deleted Successfully.');

        } catch (Exception $err) {

            return $this->error("Something went wrong. Please try again later.", 500);

        }

    }

    public function createOrUpdatePrintingService(Request $request)
    {
        try {
            $validate_rule = [
                'printingservice' => 'nullable|numeric|exists:printing_services,id',
                'billboard' => 'required|numeric|exists:billboards,id',
                'service_provider' => 'nullable|string',
                'price' => 'nullable|numeric',
                'substrate' => 'nullable|string',
                'independent' => 'nullable|boolean',
            ];

            $validator = Validator::make(array_merge($request->all(), $request->route()->parameters()),$validate_rule);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();

            $createPrintingService = [
                "billboard_id" => isset($requestArr['billboard']) ? $requestArr['billboard'] : 0,
                'service_provider' => isset($requestArr['service_provider']) ? $requestArr['service_provider'] : null,
                'price' => isset($requestArr['price']) ? $requestArr['price'] : 0,
                'substrate' => isset($requestArr['substrate']) ? $requestArr['substrate'] : null,
                'independent' => isset($requestArr['independent']) ? $requestArr['independent'] : false,
            ];

            $userArr = Auth::user();
            DB::beginTransaction();
            $statusCode = 201;
            $statusText = "Created";
            if (isset($requestArr['printingservice']) && $requestArr['printingservice'] > 0) {
                $statusCode = 200;
                $statusText = "Updated";
                $billboardArr = PrintingService::where('id', $requestArr['printingservice'])->first();
                $createPrintingService['updated_by'] = $userArr->id;
                $createPrintingService['updated_at'] = now();
                $billboardArr->update($createPrintingService);
            } else 
            {
                $createPrintingService['barcode'] = $this->generateUniqueBarcode(new PrintingService, 4);
                $createPrintingService['status'] = 1;
                $createPrintingService['added_by'] = $userArr->id;
                $createPrintingService['added_at'] = now();
                $billboardArr = PrintingService::create($createPrintingService);
            }

            DB::commit();
            return $this->success($billboardArr, "Printing Service {$statusText} Successfully.", $statusCode, true);
        } catch (ModelNotFoundException $err) {
            DB::rollBack();
            return $this->error("Billboard Not Found", 404);
        } catch (Exception $err) {
            DB::rollBack();
           return $this->error("Something went wrong. Please try again later.", 500);
        }
    }
    
    public function getPrintingServices(Request $request)
    {
        try {
            $validate_rule = [
                'printingservice' => 'required|numeric|exists:printing_services,id',
            ];

            $validator = Validator::make($request->route()->parameters(),$validate_rule);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();
            $printingArr = PrintingService::where('id', $requestArr['printingservice'])->first();
            return $this->success($printingArr, "Printing Service Retrived Successfully.", 200, false);
        } catch (ModelNotFoundException $err) {
            return $this->error("Billboard Not Found", 404);
        } catch (Exception $err) {
           return $this->error("Something went wrong. Please try again later.", 500);
        }
    }

    public function deletePrintingServices(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'printingservice' => 'required|array',
                'printingservice.*' => 'required|numeric|exists:printing_services,id'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $requestArr = $validator->validated();
            PrintingService::whereIn('id', $requestArr['printingservice'])->delete();
            return $this->success([], 'Printing Service(s) Deleted Successfully.');

        } catch (Exception $err) {

            return $this->error("Something went wrong. Please try again later.", 500);

        }

    }

    public function createOrUpdateFlightingService(Request $request)
    {
        try {
            $validate_rule = [
                'flightingservice' => 'nullable|numeric|exists:flighting_services,id',
                'billboard' => 'required|numeric|exists:billboards,id',
                'service_provider' => 'nullable|string',
                'price' => 'nullable|numeric',
                'rope_access_price' => 'nullable|numeric',
                'substrate' => 'nullable|string',
                'independent' => 'nullable|boolean',
            ];

            $validator = Validator::make(array_merge($request->all(), $request->route()->parameters()),$validate_rule);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();

            $createFlightingService = [
                "billboard_id" => isset($requestArr['billboard']) ? $requestArr['billboard'] : 0,
                'service_provider' => isset($requestArr['service_provider']) ? $requestArr['service_provider'] : null,
                'price' => isset($requestArr['price']) ? $requestArr['price'] : 0,
                'rope_access_price' => isset($requestArr['rope_access_price']) ? $requestArr['rope_access_price'] : 0,
                'substrate' => isset($requestArr['substrate']) ? $requestArr['substrate'] : null,
                'independent' => isset($requestArr['independent']) ? $requestArr['independent'] : false,
            ];

            $userArr = Auth::user();
            DB::beginTransaction();
            $statusCode = 201;
            $statusText = "Created";
            if (isset($requestArr['flightingservice']) && $requestArr['flightingservice'] > 0) {
                $statusCode = 200;
                $statusText = "Updated";
                $billboardArr = FlightingService::where('id', $requestArr['flightingservice'])->first();
                $createFlightingService['updated_by'] = $userArr->id;
                $createFlightingService['updated_at'] = now();
                $billboardArr->update($createFlightingService);
            } else 
            {
                $createFlightingService['barcode'] = $this->generateUniqueBarcode(new FlightingService, 3);
                $createFlightingService['status'] = 1;
                $createFlightingService['added_by'] = $userArr->id;
                $createFlightingService['added_at'] = now();
                $billboardArr = FlightingService::create($createFlightingService);
            }

            DB::commit();
            return $this->success($billboardArr, "Flighting Service {$statusText} Successfully.", $statusCode, true);
        } catch (ModelNotFoundException $err) {
            DB::rollBack();
            return $this->error("Billboard Not Found", 404);
        } catch (Exception $err) {
            DB::rollBack();
           return $this->error("Something went wrong. Please try again later.", 500);
        }
    }   

    public function getFlightingServices(Request $request)
    {
        try {
            $validate_rule = [
                'flightingservice' => 'required|numeric|exists:flighting_services,id',
            ];

            $validator = Validator::make($request->route()->parameters(),$validate_rule);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();
            $flightingArr = FlightingService::where('id', $requestArr['flightingservice'])->first();
            return $this->success($flightingArr, "Flighting Service Retrived Successfully.", 200, false);
        } catch (ModelNotFoundException $err) {
            return $this->error("Billboard Not Found", 404);
        } catch (Exception $err) {
           return $this->error("Something went wrong. Please try again later.", 500);
        }
    }

    public function deleteFlightingServices(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'flightingservice' => 'required|array',
                'flightingservice.*' => 'required|numeric|exists:printing_services,id'
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();
            FlightingService::whereIn('id', $requestArr['flightingservice'])->delete();
            return $this->success([], 'Flighting Service(s) Deleted Successfully.');
        } catch (Exception $err) {
            return $this->error("Something went wrong. Please try again later.", 500);

        }

    }

    public function addBillboardToCampaign(Request $request)
    {
        try {
            $validate_rule = [
                'campaign' => 'required|numeric|exists:campaigns,id',
                'billboard' => 'required|numeric|exists:billboards,id',
                'status' => 'nullable|numeric|in:0,1',
                'start_date' => 'required|date_format:Y-m-d',
                'end_date' => 'required|date_format:Y-m-d',
                'slot_duration' => 'required|numeric',
                'no_package' => 'required|numeric',
            ];

            $validator = Validator::make($request->all(),$validate_rule);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();
            $checkExist = CampaignBillboard::where('campaign', $requestArr['campaign'])->where('billboard', $requestArr['billboard'])->first();
            if($checkExist)
            {
                return $this->error("Billboard Alredy Assigned to this campaign.", 422);
            }

            $monthResult = CarbonPeriod::create($requestArr['start_date'], '1 month', $requestArr['end_date']);
            $insertInventoryData = [];
            $billboardDetails = Billboard::where('id', $requestArr['billboard'])->first();
            foreach($monthResult as $month)
            {
                $checkInventory = BillboardInventory::where('billboard', $requestArr['billboard'])->where('month', $month->format('m'))->where('year', $month->format('Y'))->first();
                if(!$checkInventory)
                {
                    $insertInventoryData[] = [
                        'billboard' => $requestArr['billboard'],
                        'month' => $month->format('m'),
                        'year' => $month->format('Y'),
                        'd1' => $billboardDetails->no_slots,
                        'd2'  => $billboardDetails->no_slots,
                        'd3'  => $billboardDetails->no_slots,
                        'd4'  => $billboardDetails->no_slots,
                        'd5'  => $billboardDetails->no_slots,
                        'd6'  => $billboardDetails->no_slots,
                        'd7'  => $billboardDetails->no_slots,
                        'd8'  => $billboardDetails->no_slots,
                        'd9'  => $billboardDetails->no_slots,
                        'd10'  => $billboardDetails->no_slots,
                        'd11'  => $billboardDetails->no_slots,
                        'd12'  => $billboardDetails->no_slots,
                        'd13'  => $billboardDetails->no_slots,
                        'd14'  => $billboardDetails->no_slots,
                        'd15'  => $billboardDetails->no_slots,
                        'd16'  => $billboardDetails->no_slots,
                        'd17'  => $billboardDetails->no_slots,
                        'd18'  => $billboardDetails->no_slots,
                        'd19'  => $billboardDetails->no_slots,
                        'd20'  => $billboardDetails->no_slots,
                        'd21'  => $billboardDetails->no_slots,
                        'd22'  => $billboardDetails->no_slots,
                        'd23'  => $billboardDetails->no_slots,
                        'd24'  => $billboardDetails->no_slots,
                        'd25'  => $billboardDetails->no_slots,
                        'd26'  => $billboardDetails->no_slots,
                        'd27'  => $billboardDetails->no_slots,
                        'd28'  => $billboardDetails->no_slots,
                        'd29'  => $billboardDetails->no_slots,
                        'd30'  => $billboardDetails->no_slots,
                        'd31'  => $billboardDetails->no_slots,
                    ];
                }
            }

            if(count($insertInventoryData) > 0)
            {
                BillboardInventory::insert($insertInventoryData);
            }

            $userArr = Auth::user();
            DB::beginTransaction();


            $no_package = isset($requestArr['no_package']) ? $requestArr['no_package'] : 0;
            $slot_duration = isset($requestArr['slot_duration']) ? $requestArr['slot_duration'] : 0;
            $addBillboardDetails = [
                'campaign' => isset($requestArr['campaign']) ? $requestArr['campaign'] : null,
                'billboard' => isset($requestArr['billboard']) ? $requestArr['billboard'] : null,
                'status' => isset($requestArr['status']) ? $requestArr['status'] : 0,
                'slot_duration' => $slot_duration,
                'no_package' => $no_package,
                'start_date' => isset($requestArr['start_date']) ? $requestArr['start_date'] : 0,
                'end_date' => isset($requestArr['end_date']) ? $requestArr['end_date'] : 0,
                'added_by' => $userArr->id,
                'added_at' => now()
            ];

            $billboardArr = CampaignBillboard::create($addBillboardDetails);

            $durationDate = CarbonPeriod::create($requestArr['start_date'], $requestArr['end_date']);

            foreach($durationDate as $date)
            {
                $inventoryData = BillboardInventory::where('billboard', $requestArr['billboard'])->where('month', $date->format('m'))->where('year', $date->format('Y'))->first()->toArray();
                $updateSlots = $inventoryData['d'.$date->format('j')]-($no_package*$slot_duration);
                $inventoryData->update([
                    'd'.$date->format('j') => $updateSlots
                ]);
            }

            $statusCode = 201;
            $statusText = "Created";

            DB::commit();

            return $this->success($billboardArr, "Billboard Assigned Successfully.", 201, true);
        } catch (Exception $err) {
            DB::rollBack();
           return $this->error("Something went wrong. Please try again later.", 500);
        }
    }
    
    public function getBillboardAvailability(Request $request)
    {
        try {
            $validate_rule = [
                'billboard' => 'required|numeric|exists:billboards,id',
                'month' => 'required|date_format:m',
                'year' => 'required|date_format:Y'
            ];

            $validator = Validator::make($request->all(),$validate_rule);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $requestArr = $validator->validated();
            $inventoryData = BillboardInventory::where('billboard', $requestArr['billboard'])->where('month', $date->format('m'))->where('year', $date->format('Y'))->first();
            return $this->success($inventoryData, "Billboard Inventory Data Retrived Successfully.", 201, true);
        } catch (Exception $err) {
           return $this->error("Something went wrong. Please try again later.", 500);
        }
    }
    

    public function removeBillboardFromCampaign(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|numeric|exists:campaign_billboards,id',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $requestArr = $validator->validated();
            CampaignBillboard::where('id', $requestArr['id'])->delete();
            return $this->success([], 'Billboard(s) Removed Successfully.');

        } catch (Exception $err) {
            return $this->error("Something went wrong. Please try again later.", 500);
        }

    }
}
