<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttributeValueRequest;
use App\Models\AttributeValue;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\AttributeValueFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttributeValueController extends Controller
{
  public function index(Request $request, AttributeValueFilters $filters)
  {
    try {
      $paginate = $request->query('sizePerPage', 25);
      $result = AttributeValue::filter($filters)->paginate($paginate);

      return  $this->success(ResponseMessage::API_SUCCESS, $result);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function store(AttributeValueRequest $request)
  {
    try {
      $attribute_value = AttributeValue::create($request->validated());

      return $this->success(ResponseMessage::API_SUCCESS, $attribute_value, Response::HTTP_CREATED);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function show(AttributeValue $attribute_value)
  {
    try {
      return $this->success(ResponseMessage::API_SUCCESS, $attribute_value);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function update(AttributeValueRequest $request, $id)
  {
    try {
      $checkExist = AttributeValue::findOrFail($id);
      $response = $checkExist->update($request->all());
      return $this->success(ResponseMessage::API_SUCCESS, $response);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function destroy(AttributeValue $attribute_value)
  {
    try {
      $response = $attribute_value->delete();
      return $this->success(ResponseMessage::API_SUCCESS, $response);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }
}
