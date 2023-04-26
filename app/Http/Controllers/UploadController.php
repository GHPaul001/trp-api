<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Models\Upload;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\UploadFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UploadController extends Controller
{
    public function index(Request $request, UploadFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Upload::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(UploadRequest $request)
    {
      try {
        $upload = Upload::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $upload, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Upload $upload)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $upload);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(UploadRequest $request, $id)
    {
      try {
        $checkExist = Upload::find($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Upload $upload)
    {
      try {
          $response = $upload->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
