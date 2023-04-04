<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\TicketFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TicketController extends Controller
{
    public function index(Request $request, TicketFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Ticket::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(TicketRequest $request)
    {
      try {
        $ticket = Ticket::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $ticket, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Ticket $ticket)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $ticket);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(TicketRequest $request, Ticket $ticket)
    {
      try {
          $response = $ticket->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Ticket $ticket)
    {
      try {
          $response = $ticket->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
