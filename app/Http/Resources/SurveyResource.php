<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use PhpParser\Node\Expr\Match_;

class SurveyResource extends JsonResource
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
            "id" =>  $this->id,
            "options" => $this->options,
            "total" => $this->total,
            "Count1" => $this->count1,
            "Count2" => $this->count2,
            "Count3" => $this->count3,
            "Count4" => $this->count4,
            "Avg1" => ceil($this->avg1),
            "Avg2" => ceil($this->avg2),
            "Avg3" => ceil($this->avg3),        
            "Avg4" => ceil($this->avg4),

        ];
    }
}
