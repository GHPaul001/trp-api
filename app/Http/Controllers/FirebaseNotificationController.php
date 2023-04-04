<?php

namespace App\Http\Controllers;

use App\Http\Requests\FirebaseNotificationRequest;
use App\Models\FirebaseNotification;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\FirebaseNotificationFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FirebaseNotificationController extends Controller
{
    public function index(Request $request, FirebaseNotificationFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = FirebaseNotification::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(FirebaseNotificationRequest $request)
    {
      try {
        $firebase_notification = FirebaseNotification::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $firebase_notification, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(FirebaseNotification $firebase_notification)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $firebase_notification);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(FirebaseNotificationRequest $request, FirebaseNotification $firebase_notification)
    {
      try {
          $response = $firebase_notification->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(FirebaseNotification $firebase_notification)
    {
      try {
          $response = $firebase_notification->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
