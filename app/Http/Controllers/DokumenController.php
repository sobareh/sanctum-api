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
            // 'doc_file' => 'required|mimes:pdf',
        ]);

        if ($request->hasFile('dokumen')) {            
            $file = $request->file('dokumen');
            $file->storeAs('dokumen','pristine');
        }

        $data["doc_file"] = '111';

        $newRecord = Dokumen::create($data);

        return $this->success('data successfully added', $newRecord);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function show(Dokumen $dokumen)
    {
        $dokumenData = RestTrx::with('archives')->find($dokumen);
        $data = new DetailResource($dokumenData);

        return $this->success(
            'Detail data retrieved',
            $data,
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
            'npwp'=> 'string|max:20|nullable',
            'nama_wp'=> 'string|nullable',
            'no_spt_lb' => 'string|max:100|nullable',
            'tgl_spt_lb' => 'string|nullable',
            'no_tindaklanjut_awal' => 'string|max:100|nullable',
            'tgl_tindaklanjut_awal' => 'string|nullable',
            'user_id' => 'string|nullable',
        ]);

        $reqData = RestTrx::where('id', $id)
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
    public function destroy(Dokumen $dokumen)
    {
        //
    }
}
