<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarrierRequest;
use App\Models\Carrier;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\CarrierFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarrierController extends Controller
{
    public function index(Request $request, CarrierFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Carrier::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(CarrierRequest $request)
    {
      try {
        $carrier = Carrier::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $carrier, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Carrier $carrier)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $carrier);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(CarrierRequest $request, $id)
    {
      try {
        $checkExist = Carrier::findOrFail($id);
        $response = $checkExist->update($request->all());

          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Carrier $carrier)
    {
      try {
          $response = $carrier->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
