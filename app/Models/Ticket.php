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

    protected $fillable = ['title', 'description', 'priority_id', 'type_id', 'assignee_id', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function assignee() {
        return $this->belongsTo(User::class);
    }

    public function type() {
        return $this->belongsTo(TicketType::class);
    }

    public function priority() {
        return $this->belongsTo(Priority::class);
    }
}
