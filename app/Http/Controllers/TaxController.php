<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaxRequest;
use App\Models\Tax;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\TaxFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaxController extends Controller
{
    public function index(Request $request, TaxFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Tax::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(TaxRequest $request)
    {
      try {
        $tax = Tax::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $tax, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Tax $tax)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $tax);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function getalltaxes(Tax $tax)
    {
      try {
          $tax = Tax::where('tax_status',1)->get(['id','name']);

          return $this->success(ResponseMessage::API_SUCCESS, $tax);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function getdigitaltaxes(Tax $tax)
    {
      try {
          $tax = Tax::where('tax_status',1)->get(['id','name','status']);

          return $this->success(ResponseMessage::API_SUCCESS, $tax);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(TaxRequest $request, Tax $tax)
    {
      try {
          $response = $tax->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Tax $tax)
    {
      try {
          $response = $tax->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
