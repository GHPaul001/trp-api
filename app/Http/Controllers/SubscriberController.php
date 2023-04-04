<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriberRequest;
use App\Models\Subscriber;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\SubscriberFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubscriberController extends Controller
{
    public function index(Request $request, SubscriberFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Subscriber::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(SubscriberRequest $request)
    {
      try {
        $subscriber = Subscriber::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $subscriber, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Subscriber $subscriber)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $subscriber);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(SubscriberRequest $request, Subscriber $subscriber)
    {
      try {
          $response = $subscriber->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Subscriber $subscriber)
    {
      try {
          $response = $subscriber->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
