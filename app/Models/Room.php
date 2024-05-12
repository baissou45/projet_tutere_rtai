<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model {
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'number',
        'type',
        'price',
        'description',
        'image',
    ];

    public function hotel() {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function isBooked() {
        $lastBook = $this->bookings()->orderBy('id', 'desc')->first();
        return now()->isBetween($lastBook?->start_at, $lastBook?->end_at);
    }

    function getData(){
        return [
            'number' => $this->number,
            'price' => $this->price,
            'description' => $this->description,
            'image' => asset($this->image),
        ];
    }
}
