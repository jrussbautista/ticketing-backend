<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketTypeResource;
use App\Models\TicketType;
use Illuminate\Http\Request;

class TicketTypeActivateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, TicketType $ticketType)
    {
        $this->authorize('update', $ticketType);

        $ticketType->update(['status' => TicketType::STATUS_ACTIVE]);
        return new TicketTypeResource($ticketType);
    }
}
