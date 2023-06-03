<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\AppSetting;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function generateUniqueBarcode(Model $target, int $type)
    {
        $settingArr = AppSetting::where('type', $type)->get()->toArray();

        $singleArray = array();

        foreach ($settingArr as $setting) {
            $singleArray[$setting['field']] = $setting['value'];
        }

        $status = true;
        $prefix = (string)$singleArray['prefix_string'];
        $number = (int)$singleArray['next_number'];
        $perfixLen = strlen($prefix);
        $padLen = (int)$singleArray['number_length'];

        if ($padLen > $perfixLen) {
            $padLen = $padLen - $perfixLen;
        } else {
            $prefix = substr($prefix, 0, ($padLen - 2));
            $perfixLen = strlen($prefix);
            if ($padLen > $perfixLen) {
                $padLen = $padLen - $perfixLen;
            }
        }

        $barcode = strtoupper(Str::random(10));

        while ($status === true) {
            $barcode = (string)$prefix . str_pad($number, $padLen, '0', STR_PAD_LEFT);

            $dataArr = $target::where('barcode', $barcode)->exists();

            if (!$dataArr) {
                $status = false;
                AppSetting::where('type', $type)
                    ->where('field', 'next_number')
                    ->update(['value' => $number + 1]);
            } else {
                ++$number;
            }
        }

        return $barcode;
    }

    protected static function success($param, $message = "", $status_code = 200, $withMessage = false)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $param,
            'with_message' => $withMessage
        ], $status_code);
    }

    protected static function error($message = "", $status_code = 500)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'status_code' => $status_code
        ], $status_code);
    }
}
