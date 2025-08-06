<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'address' => $this->address,
            'email' => $this->email,

            'logo' => new LogoResource($this->whenLoaded('logo')),
            'employees' => EmployeeResource::collection($this->whenLoaded('employees')),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
