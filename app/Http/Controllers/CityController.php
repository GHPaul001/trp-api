<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\CityFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CityController extends Controller
{
    public function index(Request $request, CityFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = City::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(CityRequest $request)
    {
      try {
        $city = City::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $city, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(City $city)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $city);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(CityRequest $request,$id)
    {
      try {

        $checkExist = City::findOrFail($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(City $city)
    {
      try {
          $response = $city->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
