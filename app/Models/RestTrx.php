<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestTrx extends Model
{
    use HasFactory;

    protected $table = 'rest_trx';

    protected $fillable = ['npwp', 
                            'nama_wp', 
                            'no_spt_lb', 
                            'tgl_spt_lb', 
                            'no_tindaklanjut_awal',
                            'tgl_tindaklanjut_awal',
                            'user_id',
                        ];

    public function archives() {
        return $this->belongsToMany(RestArchives::class, 'rest_details', 'rest_trx_id', 'rest_archives_id')
                    ->withTimeStamps()
                    ->withPivot(['rest_stages_id', 'overmacht']);
    }

    // public function getUserName() {
        
    // }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
