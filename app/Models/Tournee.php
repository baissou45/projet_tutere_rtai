<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournee extends Model
{
    use HasFactory;

    protected $fillable = [
        'inspecteur_id',
        'adresse_complet',
        'date',
        'etat',
        'created_at',
        'updated_at',
    ];

    public function inspecteur()
    {
        return $this->belongsTo(User::class, 'inspecteur_id');
    }

    public function rapports()
    {
        return $this->hasMany(Rapport::class, 'tournee_id', 'id');
    }

    public function transferts()
    {
        return $this->hasMany(Transfert::class, 'tournee_id', 'id');
    }
}
