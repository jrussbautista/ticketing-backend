<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index() {
        $DEFAULT_LIMIT = 20;
        $limit = request('limit') ?? $DEFAULT_LIMIT;


        $tickets = Ticket::with(['user', 'assignee', 'type'])
            ->when(request('created_by_me') === "true", function($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->paginate($limit);
    
        return TicketResource::collection($tickets);
    }

    public function show(Ticket $ticket) {
        return new TicketResource($ticket);
    }

    public function store(StoreTicketRequest $request) {
        $validatedData = $request->validated();
        $user_id =  auth()->user()->id;    
        $validatedData['user_id'] = $user_id;
        $ticket = Ticket::create($validatedData);
        $ticket = $ticket->fresh();
        return new TicketResource($ticket);
    }

    
}
