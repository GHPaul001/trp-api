<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandTranslationRequest;
use App\Models\BrandTranslation;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\BrandTranslationFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BrandTranslationController extends Controller
{
    public function index(Request $request, BrandTranslationFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = BrandTranslation::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(BrandTranslationRequest $request)
    {
      try {
        $brand_translation = BrandTranslation::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $brand_translation, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(BrandTranslation $brand_translation)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $brand_translation);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(BrandTranslationRequest $request, $id)
    {
      try {
        $checkExist = BrandTranslation::findOrFail($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(BrandTranslation $brand_translation)
    {
      try {
          $response = $brand_translation->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
