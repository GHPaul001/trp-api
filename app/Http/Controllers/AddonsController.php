<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddonsRequest;
use App\Models\Addons;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\AddonsFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddonsController extends Controller
{
  public function index(Request $request, AddonsFilters $filters)
  {
    try {
      $paginate = $request->query('sizePerPage', 25);
      $result = Addons::filter($filters)->paginate($paginate);

      return  $this->success(ResponseMessage::API_SUCCESS, $result);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function store(AddonsRequest $request)
  {
    try {
      $addons = Addons::create($request->validated());

      return $this->success(ResponseMessage::API_SUCCESS, $addons, Response::HTTP_CREATED);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function show(Addons $addons)
  {
    try {
      return $this->success(ResponseMessage::API_SUCCESS, $addons);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function update(AddonsRequest $request, Addons $addons)
  {
    try {

      //   $request = Language::findOrFail($id);
      // $response = $request->update($request->all());

      $response = $addons->update($request->validated());
      return $this->success(ResponseMessage::API_SUCCESS, $response);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function destroy(Addons $addons)
  {
    try {
      $response = $addons->delete();
      return $this->success(ResponseMessage::API_SUCCESS, $response);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }
}
