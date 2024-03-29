<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestArchives extends Model
{
    use HasFactory;

    protected $fillable = [
        "no_dokumen",
        "tgl_dokumen",
        "url_path",
        "document_name",
        "nominal",
        "description",
    ];

    public function transactions() 
    {
        return $this->belongsToMany(RestTrx::class, 'rest_details', 'rest_archives_id', 'rest_trx_id')
                    ->withTimeStamps()
                    ->withPivot(['rest_stages_id', 'overmacht']);
    }
}
