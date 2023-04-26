<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketReplyRequest;
use App\Models\TicketReply;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\TicketReplyFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TicketReplyController extends Controller
{
    public function index(Request $request, TicketReplyFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = TicketReply::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(TicketReplyRequest $request)
    {
      try {
        $ticket_reply = TicketReply::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $ticket_reply, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(TicketReply $ticket_reply)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $ticket_reply);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(TicketReplyRequest $request, $id)
    {
      try {
        $checkExist = TicketReply::find($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(TicketReply $ticket_reply)
    {
      try {
          $response = $ticket_reply->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
