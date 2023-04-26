<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttributeTranslationsRequest;
use App\Models\AttributeTranslations;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\AttributeTranslationsFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttributeTranslationsController extends Controller
{
  public function index(Request $request, AttributeTranslationsFilters $filters)
  {
    try {
      $paginate = $request->query('sizePerPage', 25);
      $result = AttributeTranslations::filter($filters)->paginate($paginate);

      return  $this->success(ResponseMessage::API_SUCCESS, $result);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function store(AttributeTranslationsRequest $request)
  {
    try {
      $attribute_translations = AttributeTranslations::create($request->validated());

      return $this->success(ResponseMessage::API_SUCCESS, $attribute_translations, Response::HTTP_CREATED);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function show(AttributeTranslations $attribute_translations)
  {
    try {
      return $this->success(ResponseMessage::API_SUCCESS, $attribute_translations);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function update(AttributeTranslationsRequest $request, $id)
  {
    try {
      $checkExist = AttributeTranslations::findOrFail($id);
      $response = $checkExist->update($request->all());
      return $this->success(ResponseMessage::API_SUCCESS, $response);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function destroy(AttributeTranslations $attribute_translations)
  {
    try {
      $response = $attribute_translations->delete();
      return $this->success(ResponseMessage::API_SUCCESS, $response);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }
}
