<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use App\Traits\ResponseAPI;


class DokumenController extends Controller
{
    use ResponseAPI;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RestTrx::orderBy('created_at', 'desc')->get();
        $restitusi = RestitusiResource::collection($data);

        return $this->success(
            'Data Retrieved Successfully.',
            $restitusi
        );
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
            'doc_type'=> 'required|string',
            'doc_no'=> 'required|string',
            'nama' => 'required|string',
            'keterangan' => 'string|nullable',
            'page_count' => 'nullable',
            'box_id' => 'required|string',
            'loc_id' => 'required|string',
            'nip_rekam' => 'required|string',
            'tanggal_rekam' => 'required',
        ]);

        if ($request->hasFile('dokumen')) {            
            $file = $request->file('dokumen');
            $fileName = 'TIKPDSP-2024-' . $data['nama'] . '.pdf';
            $file->storeAs('dokumen', $fileName);
        }

        $data["doc_file"] = $fileName;

        $newRecord = Dokumen::create($data);

        return $this->success('data successfully added', $newRecord);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dokumenData = Dokumen::find($id);

        return $this->success(
            'Detail data retrieved',
            $dokumenData,
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dokumen $dokumen)
    {
        $inboundRequest = $request->validate([
            'doc_type'=> 'required|string',
            'doc_no'=> 'required|string',
            'nama' => 'required|string',
            'keterangan' => 'string|nullable',
            'page_count' => 'nullable',
            'box_id' => 'required|string',
            'loc_id' => 'required|string',
            'nip_rekam' => 'required|string',
            'tanggal_rekam' => 'required',
        ]);

        $reqData = Dokumen::where('id', $id)
                    ->firstOrFail()
                    ->update($inboundRequest);

        return $this->success(
            'data successfully updated.',
            $reqData
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Dokumen::find($id);

        if ($data->delete()) {
            return $this->success("data successfully deleted.");
        }

        return $this->error("error while deleting the records.");
    }
}
