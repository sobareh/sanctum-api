<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\RestStages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function stages() {
        return $this->belongsToMany(RestStages::class, 'rest_details', 'rest_trx_id', 'rest_stages_id');
    }

    public function scopeIsCompleted($query) {
        return $query->where('is_completed', '=', true)->count();
    }

    public function scopeStillProcessed($query) {
        return $query->where('is_completed','!=', true)->count();
    }

    public function scopeGetNewestRecords($query) {
        $date = Carbon::now()->subDays(10);
        
        return $query->select('nama_wp','no_tindaklanjut_awal')
                    ->where('created_at','>=',$date)
                    ->orderBy('created_at', 'desc')
                    ->limit(7)
                    ->get();
    }

    public function scopeDueDateRecords($query) {
        $data = $query->where('is_completed','=','false')->get();

        $results = array();

        foreach ($data as $item => $value) {
            $date2 = new Carbon($value->tgl_tindaklanjut_awal);
            $dueDate = $date2->addDays(30);

            if (Carbon::now()->diffInDays($dueDate) <= 7) {
                $results[] = $value;
            }
        }

        return $results;
    }
}
