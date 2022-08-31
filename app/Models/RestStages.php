<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RestStages extends Model
{
    use HasFactory;

    public function scopegetPathId($query, $trxId, $stageId) {
        
        $data = $query->find($stageId);

        $idArchives = strlen($trxId);

        $setIdArchives;
        switch ($idArchives) {
            case 1:
                $setIdArchives =  "000" . $trxId;
                break;
            case 2:
                $setIdArchives =  "00" . $trxId;
                break;
            case 3:
                $setIdArchives =  "0" . $trxId;
                break;
            case 4:
                $setIdArchives =  $trxId;
                break;
            default:
                $setIdArchives =  $trxId;
                break;
        }

        $randomString = $this->generateRandomString(3);

        $folderName = "DBR" . $setIdArchives . "-" . "2022";
        $fileName = $setIdArchives . $randomString . "0" . $data->id . "-" . $data->document_id . ".pdf";

        return [$folderName, $fileName];
    }

    public function generateRandomString($length = 3) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
