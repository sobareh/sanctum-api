<?php

namespace App\Http\Resources;

use App\Http\Resources\ArchiveResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailResource extends JsonResource
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
            'npwp' => $this->npwp,
            'nama_wp' => $this->nama_wp,
            'no_tindaklanjut_awal' => $this->no_tindaklanjut_awal,
            'tgl_tindaklanjut_awal' => $this->tgl_tindaklanjut_awal,
            'is_completed' => $this->is_completed,
            'user_id' => $this->user->name,
            'archives' => ArchiveResource::collection($this->archives)
        ];
    }
}
