<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TourneeResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        // return parent::toArray($request);

        return [
            "adresse_complet" => $this->adresse_complet,
            "date" => $this->date,
            "etat" => $this->etat,
        ];

    }
}
