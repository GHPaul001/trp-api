<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProxypayPaymentRequest;
use App\Models\ProxypayPayment;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\ProxypayPaymentFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProxypayPaymentController extends Controller
{
    public function index(Request $request, ProxypayPaymentFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = ProxypayPayment::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(ProxypayPaymentRequest $request)
    {
      try {
        $proxypay_payment = ProxypayPayment::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $proxypay_payment, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(ProxypayPayment $proxypay_payment)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $proxypay_payment);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(ProxypayPaymentRequest $request, ProxypayPayment $proxypay_payment)
    {
      try {
          $response = $proxypay_payment->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(ProxypayPayment $proxypay_payment)
    {
      try {
          $response = $proxypay_payment->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
