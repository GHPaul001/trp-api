<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerPackagePaymentRequest;
use App\Models\CustomerPackagePayment;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\CustomerPackagePaymentFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerPackagePaymentController extends Controller
{
    public function index(Request $request, CustomerPackagePaymentFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = CustomerPackagePayment::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(CustomerPackagePaymentRequest $request)
    {
      try {
        $customer_package_payment = CustomerPackagePayment::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $customer_package_payment, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(CustomerPackagePayment $customer_package_payment)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $customer_package_payment);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(CustomerPackagePaymentRequest $request, CustomerPackagePayment $customer_package_payment)
    {
      try {
          $response = $customer_package_payment->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(CustomerPackagePayment $customer_package_payment)
    {
      try {
          $response = $customer_package_payment->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
