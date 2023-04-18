<?php

namespace App\Http\Traits;

use App\Enums\CacheKeys;
use App\Models\Version;
use Illuminate\Support\Facades\Cache;

trait ResponseTrait
{
    /**
     * Core of response
     *
     * @param   string          $message
     * @param   array|object|bool    $data
     * @param   integer         $statusCode
     * @param   bool            $isSuccess
     */
    public function coreResponse($message, $statusCode, $data = null, $isSuccess = true)
    {
        // Check the params
        if(!$message){
            $message = "Something went wrong.";
        }

        // Send the response
        if($isSuccess) {
            // $version = Cache::rememberForever(CacheKeys::AppVersion, function () {
            //     return Version::orderBy('created_at', 'desc')->pluck('app_version')->first();
            // });
            return response()->json([
                'message' => $message,
                'code' => $statusCode,
                'results' => $data,
                // 'version' => $version
            ], $statusCode);
        } else {
            return response()->json([
                'message' => $message,
                'error' => true,
                'code' => $statusCode,
            ], $statusCode);
        }
    }

    /**
     * Send any success response
     *
     * @param   string          $message
     * @param   array|object|bool    $data
     * @param   int             $statusCode
     */
    public function success($message, $data, $statusCode = 200)
    {
        return $this->coreResponse($message, $statusCode, $data);
    }

    /**
     * Send any error response
     *
     * @param   string          $message
     * @param   int             $statusCode
     */
    public function error($message, $statusCode = 500, $data = false)
    {
        return $this->coreResponse($message, $statusCode, $data);
    }
}
