<?php

namespace App\Http\Resources\Schedule;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ScheduleCollection extends ResourceCollection
{
    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    public $preserveKeys = true;
    
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "ok" => true,
            "msg" => "Success",
            "data" => [
                "schedules" => $this->collection,
            ],
            "meta" => [],
            "links" => [],
        ];
    }
}
