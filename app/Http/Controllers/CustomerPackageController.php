<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerPackageRequest;
use App\Models\CustomerPackage;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\CustomerPackageFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerPackageController extends Controller
{
    public function index(Request $request, CustomerPackageFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = CustomerPackage::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(CustomerPackageRequest $request)
    {
      try {
        $customer_package = CustomerPackage::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $customer_package, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(CustomerPackage $customer_package)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $customer_package);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(CustomerPackageRequest $request, $id)
    {
      try {
        $checkExist = CustomerPackage::findOrFail($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(CustomerPackage $customer_package)
    {
      try {
          $response = $customer_package->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
