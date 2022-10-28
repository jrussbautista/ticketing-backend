<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketTypeResource;
use App\Models\TicketType;
use Illuminate\Http\Request;

class TicketTypeDeactivateController extends Controller
{
    public function __invoke(Request $request, TicketType $ticketType)
    {
        $ticketType->update(['status' => TicketType::STATUS_INACTIVE]);
        return new TicketTypeResource($ticketType);
    }
}
