<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessSettingRequest;
use App\Models\BusinessSetting;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\BusinessSettingFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusinessSettingController extends Controller
{
    public function index(Request $request, BusinessSettingFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = BusinessSetting::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(BusinessSettingRequest $request)
    {
      try {
        $business_setting = BusinessSetting::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $business_setting, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(BusinessSetting $business_setting)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $business_setting);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(BusinessSettingRequest $request, $id)
    {
      try {
        $checkExist = BusinessSetting::findOrFail($id);
        $response = $checkExist->update($request->all());
          // $response = $business_setting->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(BusinessSetting $business_setting)
    {
      try {
          $response = $business_setting->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
