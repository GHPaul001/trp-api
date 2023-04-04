<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductTranslationRequest;
use App\Models\ProductTranslation;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\ProductTranslationFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductTranslationController extends Controller
{
    public function index(Request $request, ProductTranslationFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = ProductTranslation::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(ProductTranslationRequest $request)
    {
      try {
        $product_translation = ProductTranslation::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $product_translation, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(ProductTranslation $product_translation)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $product_translation);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(ProductTranslationRequest $request, ProductTranslation $product_translation)
    {
      try {
          $response = $product_translation->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(ProductTranslation $product_translation)
    {
      try {
          $response = $product_translation->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
