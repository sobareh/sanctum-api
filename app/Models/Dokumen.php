<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'doc_type',
        'doc_no',
        'nama' ,
        'keterangan',
        'page_count',
        'box_id' ,
        'loc_id' ,
        'nip_rekam' ,
        'tanggal_rekam',
        'doc_file',
    ];

}
