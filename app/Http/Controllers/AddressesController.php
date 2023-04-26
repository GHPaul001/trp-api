<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressesRequest;
use App\Models\Addresses;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\AddressesFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddressesController extends Controller
{
    public function index(Request $request, AddressesFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Addresses::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(AddressesRequest $request)
    {
      try {
        $addresses = Addresses::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $addresses, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Addresses $addresses)
    {
      try {
        // $request = Language::findOrFail($id);
        // $response = $request->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $addresses);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(AddressesRequest $request, $id)
    {
      try {
        $checkExist = Addresses::findOrFail($id);
        $response = $checkExist->update($request->all());
          // $response = $addresses->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Addresses $addresses)
    {
      try {
          $response = $addresses->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
