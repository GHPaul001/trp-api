<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandsRequest;
use App\Models\Brands;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\BrandsFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BrandsController extends Controller
{
    public function index(Request $request, BrandsFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Brands::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(BrandsRequest $request)
    {
      try {
        $brands = Brands::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $brands, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Brands $brands)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $brands);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(BrandsRequest $request, Brands $brands)
    {
      try {
          $response = $brands->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Brands $brands)
    {
      try {
          $response = $brands->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
