<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model {
    use HasFactory;

    protected $fillable = [
        "user_id",
        "room_id",
        "client_id",
        "reservation_id",
        "status_id",
        "start_at",
        "end_at",
        "payload"
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function room() {
        return $this->belongsTo(Room::class);
    }

    // public function client() {
    //     return $this->belongsTo(Client::class);
    // }
}
