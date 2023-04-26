<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttributeCategoryRequest;
use App\Models\AttributeCategory;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\AttributeCategoryFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttributeCategoryController extends Controller
{
  public function index(Request $request, AttributeCategoryFilters $filters)
  {
    try {
      $paginate = $request->query('sizePerPage', 25);
      $result = AttributeCategory::filter($filters)->paginate($paginate);

      return  $this->success(ResponseMessage::API_SUCCESS, $result);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function store(AttributeCategoryRequest $request)
  {
    try {
      $attribute_category = AttributeCategory::create($request->validated());

      return $this->success(ResponseMessage::API_SUCCESS, $attribute_category, Response::HTTP_CREATED);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function show(AttributeCategory $attribute_category)
  {
    try {
      return $this->success(ResponseMessage::API_SUCCESS, $attribute_category);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function update(AttributeCategoryRequest $request, $id)
  {
    try {
      $checkExist = AttributeCategory::findOrFail($id);
      $response = $checkExist->update($request->all());
      return $this->success(ResponseMessage::API_SUCCESS, $response);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function destroy(AttributeCategory $attribute_category)
  {
    try {
      $response = $attribute_category->delete();
      return $this->success(ResponseMessage::API_SUCCESS, $response);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }
}
