<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index() {
        $DEFAULT_LIMIT = 20;
        $limit = request('limit') ?? $DEFAULT_LIMIT;
        $tickets = Ticket::with(['user', 'assignee', 'type'])->paginate($limit);
        return TicketResource::collection($tickets);
    }

    public function show(Ticket $ticket) {
        return new TicketResource($ticket);
    }

    
}
