<?php

namespace App\Http\Controllers;

use App\Http\Requests\PickupPointRequest;
use App\Models\PickupPoint;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\PickupPointFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PickupPointController extends Controller
{
    public function index(Request $request, PickupPointFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = PickupPoint::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(PickupPointRequest $request)
    {
      try {
        $pickup_point = PickupPoint::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $pickup_point, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(PickupPoint $pickup_point)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $pickup_point);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(PickupPointRequest $request, $id)
    {
      try {
        $checkExist = PickupPoint::find($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(PickupPoint $pickup_point)
    {
      try {
          $response = $pickup_point->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
