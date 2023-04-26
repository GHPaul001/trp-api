<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\CouponFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CouponController extends Controller
{
    public function index(Request $request, CouponFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Coupon::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(CouponRequest $request)
    {
      try {
        $coupon = Coupon::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $coupon, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Coupon $coupon)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $coupon);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(CouponRequest $request, $id)
    {
      try {
        $checkExist = Coupon::findOrFail($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Coupon $coupon)
    {
      try {
          $response = $coupon->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
