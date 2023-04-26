<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use App\Models\PasswordReset;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\PasswordResetFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PasswordResetController extends Controller
{
    public function index(Request $request, PasswordResetFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = PasswordReset::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(PasswordResetRequest $request)
    {
      try {
        $password_reset = PasswordReset::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $password_reset, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(PasswordReset $password_reset)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $password_reset);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(PasswordResetRequest $request, $id)
    {
      try {
        $checkExist = PasswordReset::find($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(PasswordReset $password_reset)
    {
      try {
          $response = $password_reset->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
