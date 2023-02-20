<?php

namespace App\Http\Resources;

use App\Http\Controllers\ArrivalController;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Arrival;

class ArrivalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'class' => $this->class,
            'arrivals' => Arrival::where('student_id', $this->id)->get(),
        ];
    }
}
