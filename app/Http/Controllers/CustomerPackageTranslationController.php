<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerPackageTranslationRequest;
use App\Models\CustomerPackageTranslation;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\CustomerPackageTranslationFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerPackageTranslationController extends Controller
{
    public function index(Request $request, CustomerPackageTranslationFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = CustomerPackageTranslation::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(CustomerPackageTranslationRequest $request)
    {
      try {
        $customer_package_translation = CustomerPackageTranslation::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $customer_package_translation, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(CustomerPackageTranslation $customer_package_translation)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $customer_package_translation);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(CustomerPackageTranslationRequest $request, CustomerPackageTranslation $customer_package_translation)
    {
      try {
          $response = $customer_package_translation->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(CustomerPackageTranslation $customer_package_translation)
    {
      try {
          $response = $customer_package_translation->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
