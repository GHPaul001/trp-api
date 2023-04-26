<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRequest;
use App\Models\Staff;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\StaffFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaffController extends Controller
{
    public function index(Request $request, StaffFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Staff::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(StaffRequest $request)
    {
      try {
        $staff = Staff::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $staff, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Staff $staff)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $staff);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(StaffRequest $request, $id)
    {
      try {
        $checkExist = Staff::find($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Staff $staff)
    {
      try {
          $response = $staff->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
