<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\AttributeFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttributeController extends Controller
{
    public function index(Request $request, AttributeFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Attribute::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(AttributeRequest $request)
    {
      try {
        $attribute = Attribute::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $attribute, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Attribute $attribute)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $attribute);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function getallattributes(Attribute $attribute)
    {
      try {
          $attribute=Attribute::get(['id','name']);
          return $this->success(ResponseMessage::API_SUCCESS, $attribute);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(AttributeRequest $request, $id)
    {
      try {
        $checkExist = Attribute::findOrFail($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Attribute $attribute)
    {
      try {
          $response = $attribute->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
