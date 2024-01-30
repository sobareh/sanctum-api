<?php

namespace App\Http\Controllers\Api;

use App\Models\RestTrx;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DetailResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\RestitusiResource;

class RestitusiController extends Controller
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
            'npwp'=> 'required|string|max:20',
            'nama_wp'=> 'required|string',
            'no_spt_lb' => 'string|max:100|nullable',
            'tgl_spt_lb' => 'string|nullable',
            'no_tindaklanjut_awal' => 'string|max:100|nullable',
            'tgl_tindaklanjut_awal' => 'string|nullable',
            'user_id' => 'required|string',
        ]);

        $newRecord = RestTrx::create($data);

        return $this->success('data successfully added', $newRecord);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restitusiData = RestTrx::with('archives')->find($id);
        $data = new DetailResource($restitusiData);

        return $this->success(
            'Detail data retrieved',
            $data,
        );
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = RestTrx::find($id);

        if ($data->delete()) {
            return $this->success("data successfully deleted.");
        }

        return $this->error("error while deleting the records.");
    }
}
