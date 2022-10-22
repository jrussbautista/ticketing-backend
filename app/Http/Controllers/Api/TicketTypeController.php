<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketTypeResource;
use App\Models\TicketType;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    public function index() {
        $DEFAULT_LIMIT = 20;
        $limit = request('limit') ?? $DEFAULT_LIMIT;

        $tickets = TicketType::paginate($limit);
        return TicketTypeResource::collection($tickets);
    }
}
