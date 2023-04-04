<?php

namespace App\Http\Controllers;

use App\Http\Requests\PickupPointTranslationnRequest;
use App\Models\PickupPointTranslationn;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\PickupPointTranslationnFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PickupPointTranslationnController extends Controller
{
    public function index(Request $request, PickupPointTranslationnFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = PickupPointTranslationn::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(PickupPointTranslationnRequest $request)
    {
      try {
        $pickup_point_translationn = PickupPointTranslationn::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $pickup_point_translationn, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(PickupPointTranslationn $pickup_point_translationn)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $pickup_point_translationn);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(PickupPointTranslationnRequest $request, PickupPointTranslationn $pickup_point_translationn)
    {
      try {
          $response = $pickup_point_translationn->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(PickupPointTranslationn $pickup_point_translationn)
    {
      try {
          $response = $pickup_point_translationn->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
