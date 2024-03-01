<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RapportResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        // return parent::toArray($request);

        return [
            "tournee_id" => $this->tournee_id,
            "signature" => $this->signature,
            "fichier_joint" => $this->fichier_joint,
            "description" => $this->description,
        ];

    }
}
