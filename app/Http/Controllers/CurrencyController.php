<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\CurrencyFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CurrencyController extends Controller
{
    public function index(Request $request, CurrencyFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Currency::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(CurrencyRequest $request)
    {
      try {
        $currency = Currency::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $currency, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Currency $currency)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $currency);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(CurrencyRequest $request, $id)
    {
      try {
        $checkExist = Currency::findOrFail($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Currency $currency)
    {
      try {
          $response = $currency->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
