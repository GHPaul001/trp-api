<?php

namespace App\Http\Controllers;

use App\Http\Requests\PickupPointTranslationRequest;
use App\Models\PickupPointTranslation;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\PickupPointTranslationFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PickupPointTranslationController extends Controller
{
    public function index(Request $request, PickupPointTranslationFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = PickupPointTranslation::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(PickupPointTranslationRequest $request)
    {
      try {
        $pickup_point_translation = PickupPointTranslation::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $pickup_point_translation, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(PickupPointTranslation $pickup_point_translation)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $pickup_point_translation);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(PickupPointTranslationRequest $request, $id)
    {
      try {
        $checkExist = PickupPointTranslation::find($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(PickupPointTranslation $pickup_point_translation)
    {
      try {
          $response = $pickup_point_translation->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
