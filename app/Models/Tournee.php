<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tournee extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "inspecteur_id",
        "adresse_complet",
        "date",
        "etat",
    ];

    public function inspecteur() {
        return $this->belongsTo(User::class, "inspecteur_id");
    }

    public function rapports() {
        return $this->hasMany(Rapport::class, "tournee_id", "id");
    }

}
