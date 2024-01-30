<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArchiveResource extends JsonResource
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
            'no_dokumen' => $this->no_dokumen,        
            'tgl_dokumen' => $this->tgl_dokumen,        
            'url_path' => $this->url_path,        
            'document_name' => $this->document_name,        
            'nominal' => $this->nominal,        
            'description' => $this->description,        
            'created_at' => $this->created_at,        
            'updated_at' => $this->updated_at,
            'rest_trx_id' => $this->pivot->rest_trx_id,      
            'rest_archives_id' => $this->pivot->rest_archives_id,      
            'rest_stages_id' => $this->pivot->rest_stages_id,      
            'overmacht' => $this->pivot->overmacht,      
        ];
    }
}
