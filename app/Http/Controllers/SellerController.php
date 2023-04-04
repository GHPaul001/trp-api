<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellerRequest;
use App\Models\Seller;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\SellerFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerController extends Controller
{
    public function index(Request $request, SellerFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Seller::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(SellerRequest $request)
    {
      try {
        $seller = Seller::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $seller, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Seller $seller)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $seller);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(SellerRequest $request, Seller $seller)
    {
      try {
          $response = $seller->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Seller $seller)
    {
      try {
          $response = $seller->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
