<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model {
    use HasFactory;

    protected $fillable = [
        "name",
        "address",
        "city",
        "country",
        "zip",
        "rate",
        "description",
        "user_id",
        "tel",
        "email",
        "long",
        "lat",
        "state",
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function rooms() {
        return $this->hasMany(Room::class);
    }
}
