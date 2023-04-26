<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountriesRequest;
use App\Models\Countries;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\CountriesFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CountriesController extends Controller
{
    public function index(Request $request, CountriesFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Countries::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(CountriesRequest $request)
    {
      try {
        $countries = Countries::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $countries, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Countries $countries)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $countries);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(CountriesRequest $request, $id)
    {
      try {
        $checkExist = Countries::findOrFail($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Countries $countries)
    {
      try {
          $response = $countries->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
