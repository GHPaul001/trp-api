<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerProductTranslationRequest;
use App\Models\CustomerProductTranslation;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\CustomerProductTranslationFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerProductTranslationController extends Controller
{
    public function index(Request $request, CustomerProductTranslationFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = CustomerProductTranslation::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(CustomerProductTranslationRequest $request)
    {
      try {
        $customer_product_translation = CustomerProductTranslation::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $customer_product_translation, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(CustomerProductTranslation $customer_product_translation)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $customer_product_translation);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(CustomerProductTranslationRequest $request,$id)
    {
      try {

        $checkExist = CustomerProductTranslation::findOrFail($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(CustomerProductTranslation $customer_product_translation)
    {
      try {
          $response = $customer_product_translation->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
