<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleHasPermissionRequest;
use App\Models\RoleHasPermission;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\RoleHasPermissionFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleHasPermissionController extends Controller
{
    public function index(Request $request, RoleHasPermissionFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = RoleHasPermission::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(RoleHasPermissionRequest $request)
    {
      try {
        $role_has_permission = RoleHasPermission::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $role_has_permission, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(RoleHasPermission $role_has_permission)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $role_has_permission);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(RoleHasPermissionRequest $request, $id)
    {
      try {
        $checkExist = RoleHasPermission::find($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(RoleHasPermission $role_has_permission)
    {
      try {
          $response = $role_has_permission->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
