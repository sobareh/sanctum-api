<?php

namespace App\Http\Controllers\Api;

use App\Traits\ResponseAPI;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\{RestArchives,RestStages};

class ArchiveController extends Controller
{
    use ResponseAPI;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "dokumen" => "required|mimes:pdf|max:2048",
            "no_dokumen" => "required|string",
            "tgl_dokumen" => "required|string",
            "nominal" => "required|numeric",
            "description" => "required|string",
            "rest_trx_id" => "required|string",
            "rest_stages_id" => "required|string",
        ]);

        $itemPivot = Arr::only($data, ['rest_trx_id', 'rest_stages_id']);
        ["rest_trx_id" => $rest_trx_id, "rest_stages_id" => $rest_stages_id] = $itemPivot;

        $itemData = Arr::except($data, ['rest_trx_id', 'rest_stages_id']);
        
        $filePath = RestStages::getPathId($rest_trx_id, $rest_stages_id);
        [$folderName, $fileName] = $filePath;

        $itemData["url_path"] = $folderName;
        $itemData["document_name"] = $fileName;
        $recordItem = RestArchives::create($itemData);

        $recordPivot = $recordItem->transactions()->attach(
            $rest_trx_id, 
            ["rest_stages_id" => $rest_stages_id]
        );

        $file = $request->file('dokumen');
        var_dump($file);
        $file->storeAs($folderName, $fileName, 'public');

       return response()->json([
           $recordItem,
           $recordPivot
       ]);                         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = RestArchives::find($id);

        $file = Storage::disk('public');
        $filePath = $data->url_path . '/' . $data->document_name ;
        $isDeleted = $file->exists($filePath) ? $file->delete($filePath) : false;
        
        if ($isDeleted && $data->delete()) {
            return $this->success(
                'data deleted succesfully',
                true
            );
        }
    }
}
