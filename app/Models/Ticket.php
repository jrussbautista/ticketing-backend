<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    const STATUS_PENDING = "pending";
    const STATUS_SOLVED = "solved";
    const STATUS_CANCELLED = "cancelled";
    const STATUS_CLOSED = "closed";

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function assignee() {
        return $this->belongsTo(User::class);
    }

    public function type() {
        return $this->belongsTo(TicketType::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function priority() {
        return $this->belongsTo(Priority::class);
    }
}
