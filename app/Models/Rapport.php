<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model {
    use HasFactory;

    protected $fillable = [
        "inspecteur_id",
        "tournee_id",
        "signature",
        "fichier_joint",
        "description",
    ];

    public function inspecteur() {
        return $this->belongsTo(User::class, "inspecteur_id");
    }

    public function tournee() {
        return $this->belongsTo(Tournee::class, "tornee_id");
    }
}
