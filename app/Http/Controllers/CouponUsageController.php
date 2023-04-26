<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponUsageRequest;
use App\Models\CouponUsage;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\CouponUsageFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CouponUsageController extends Controller
{
    public function index(Request $request, CouponUsageFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = CouponUsage::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(CouponUsageRequest $request)
    {
      try {
        $coupon_usage = CouponUsage::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $coupon_usage, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(CouponUsage $coupon_usage)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $coupon_usage);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(CouponUsageRequest $request, $id)
    {
      try {
        $checkExist = CouponUsage::findOrFail($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(CouponUsage $coupon_usage)
    {
      try {
          $response = $coupon_usage->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
