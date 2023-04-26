<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarrierRangeRequest;
use App\Models\CarrierRange;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\CarrierRangeFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarrierRangeController extends Controller
{
    public function index(Request $request, CarrierRangeFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = CarrierRange::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(CarrierRangeRequest $request)
    {
      try {
        $carrier_range = CarrierRange::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $carrier_range, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(CarrierRange $carrier_range)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $carrier_range);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(CarrierRangeRequest $request, $id)
    {
      try {
        $checkExist = CarrierRange::findOrFail($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(CarrierRange $carrier_range)
    {
      try {
          $response = $carrier_range->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
