<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommisionHistoryRequest;
use App\Models\CommisionHistory;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\CommisionHistoryFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommisionHistoryController extends Controller
{
    public function index(Request $request, CommisionHistoryFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = CommisionHistory::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(CommisionHistoryRequest $request)
    {
      try {
        $commision_history = CommisionHistory::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $commision_history, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(CommisionHistory $commision_history)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $commision_history);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(CommisionHistoryRequest $request, CommisionHistory $commision_history)
    {
      try {
          $response = $commision_history->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(CommisionHistory $commision_history)
    {
      try {
          $response = $commision_history->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
