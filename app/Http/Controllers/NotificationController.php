<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationRequest;
use App\Models\Notification;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\NotificationFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends Controller
{
    public function index(Request $request, NotificationFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Notification::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(NotificationRequest $request)
    {
      try {
        $notification = Notification::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $notification, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Notification $notification)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $notification);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(NotificationRequest $request, Notification $notification)
    {
      try {
          $response = $notification->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Notification $notification)
    {
      try {
          $response = $notification->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
