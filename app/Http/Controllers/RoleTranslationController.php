<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleTranslationRequest;
use App\Models\RoleTranslation;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\RoleTranslationFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleTranslationController extends Controller
{
    public function index(Request $request, RoleTranslationFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = RoleTranslation::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(RoleTranslationRequest $request)
    {
      try {
        $role_translation = RoleTranslation::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $role_translation, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(RoleTranslation $role_translation)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $role_translation);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(RoleTranslationRequest $request, RoleTranslation $role_translation)
    {
      try {
          $response = $role_translation->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(RoleTranslation $role_translation)
    {
      try {
          $response = $role_translation->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
