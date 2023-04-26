<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopRequest;
use App\Models\Shop;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\ShopFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShopController extends Controller
{
    public function index(Request $request, ShopFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Shop::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(ShopRequest $request)
    {
      try {
        $shop = Shop::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $shop, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Shop $shop)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $shop);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(ShopRequest $request,$id )
    {
      try {
        $checkExist = Shop::find($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Shop $shop)
    {
      try {
          $response = $shop->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
