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
    public function index(Request $request)
    {
      try {
            $request = Brands::select('id','name','logo')->get();
            return  $this->success(ResponseMessage::API_SUCCESS, $request);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(BrandsRequest $request)
    {
      try {
        Brands::create($request->all());

        return $this->success(ResponseMessage::API_SUCCESS, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function getBrandName(Brands $brands)
    {
      try {
        $brands = Brands::get(['name']);
        return $this->success(ResponseMessage::API_SUCCESS, $brands, Response::HTTP_OK);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function getBrandsAll(Brands $brands)
    {
      try {
        $brands = Brands::get([' id', 'name', 'logo']);
        return $this->success(ResponseMessage::API_SUCCESS, $brands, Response::HTTP_OK);
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

    public function update(BrandsRequest $request,$id)
    {
      try {
          // $request 
          $checkExist = Brands::findOrFail($id);
          $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Brands $brands,$id)
    {
      try {
          $checkExist = $brands->findOrFail($id);
          $response = $checkExist->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
