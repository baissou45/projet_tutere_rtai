<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfert extends Model {
    use HasFactory;

    protected $fillable = [
        "inspecteur_id",
        "secretaire_id",
        "date_debut",
        "date_fin",
        "description",
    ];

    public function inspecteur() {
        return $this->belongsTo(User::class, "inspecteur_id");
    }

    public function newSecretaire() {
        return $this->belongsTo(User::class, "secretaire_id");
    }

    public function secretaire() {
        return $this->inspecteur->secretaire;
    }
}
