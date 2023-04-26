<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarrierPriceRangeRequest;
use App\Models\CarrierPriceRange;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\CarrierPriceRangeFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarrierPriceRangeController extends Controller
{
    public function index(Request $request, CarrierPriceRangeFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = CarrierPriceRange::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(CarrierPriceRangeRequest $request)
    {
      try {
        $carrier_price_range = CarrierPriceRange::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $carrier_price_range, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(CarrierPriceRange $carrier_price_range)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $carrier_price_range);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(CarrierPriceRangeRequest $request, $id)
    {
      try {
        $checkExist = CarrierPriceRange::findOrFail($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(CarrierPriceRange $carrier_price_range)
    {
      try {
          $response = $carrier_price_range->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
