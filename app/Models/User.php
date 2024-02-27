<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "nom",
        "prenom",
        "password",
        "sexe",
        "tel",
        "email",
        "type",
        "secretaire_id"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function secretaire() {
        return $this->belongsTo(User::class, "secretaire_id");
    }

    public function inspecteurs() {
        return $this->hasMany(User::class, "secretaire_id");
    }

    // Voir l'historique des inspecteurs tranférés vers un secrétaire
    public function tranferts_vers_moi(){
        return $this->hasMany(Transfert::class, 'secretaire_id');
    }

    // Voir l'historique des transferts d'un inspecteur
    public function inspecteur_tranferts(){
        return $this->hasMany(Transfert::class, 'inspecteur_id');
    }

    // Savoir si un inspecteur est actuellement tranférer
    public function est_tranferer(){
        //
    }
}