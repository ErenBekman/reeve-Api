<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class NotiResource extends JsonResource
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
            'id' => $this->id,
            'NameSurname' => $this->NameSurname,
            'ComeDate' => Carbon::parse($this->ComeDate)->format('d-m-Y'),
            'WhereFrom' => $this->WhereFrom,
            'WhoTook' => $this->WhoTook,
            'DeliverDate' => Carbon::parse($this->DeliverDate)->format('d-m-Y'),
            'totaly' => $this->Totaly,
        ];
    }
}
