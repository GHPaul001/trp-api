<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaykuPaymentRequest;
use App\Models\PaykuPayment;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\PaykuPaymentFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaykuPaymentController extends Controller
{
    public function index(Request $request, PaykuPaymentFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = PaykuPayment::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(PaykuPaymentRequest $request)
    {
      try {
        $payku_payment = PaykuPayment::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $payku_payment, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(PaykuPayment $payku_payment)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $payku_payment);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(PaykuPaymentRequest $request, $id)
    {
      try {
        $checkExist = PaykuPayment::find($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(PaykuPayment $payku_payment)
    {
      try {
          $response = $payku_payment->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
