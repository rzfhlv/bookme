<?php

namespace App\Http\Resources\Conselor;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConselorDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "ok" => true,
            "msg" => "Success",
            "data" => [
                "conselor" => parent::toArray($request),
            ],
        ];
    }
}
