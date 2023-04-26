<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppTranslationRequest;
use App\Models\AppTranslation;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\AppTranslationFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppTranslationController extends Controller
{
  public function index(Request $request, AppTranslationFilters $filters)
  {
    try {
      $paginate = $request->query('sizePerPage', 25);
      $result = AppTranslation::filter($filters)->paginate($paginate);

      return  $this->success(ResponseMessage::API_SUCCESS, $result);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function store(AppTranslationRequest $request)
  {
    try {
      $app_translation = AppTranslation::create($request->validated());

      return $this->success(ResponseMessage::API_SUCCESS, $app_translation, Response::HTTP_CREATED);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function show(AppTranslation $app_translation)
  {
    try {
      return $this->success(ResponseMessage::API_SUCCESS, $app_translation);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function update(AppTranslationRequest $request, $id)
  {
    try {
      $checkExist = AppTranslation::findOrFail($id);
      $response = $checkExist->update($request->all());
      return $this->success(ResponseMessage::API_SUCCESS, $response);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function destroy(AppTranslation $app_translation)
  {
    try {
      $response = $app_translation->delete();
      return $this->success(ResponseMessage::API_SUCCESS, $response);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }
}
