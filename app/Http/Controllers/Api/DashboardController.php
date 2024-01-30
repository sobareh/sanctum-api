<?php

namespace App\Http\Controllers\Api;

use App\Models\RestTrx;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    use ResponseAPI;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $isCompleted = RestTrx::IsCompleted();
        $stillProcessed = RestTrx::StillProcessed();
        $newestRecords = RestTrx::GetNewestRecords();
        $dueDateRecords = RestTrx::DueDateRecords();

        $data = [
            'newest_records' => $newestRecords,
            'is_completed' => $isCompleted,
            'still_processed' => $stillProcessed,
            'due_date_records' => $dueDateRecords
        ];

        return $this->success(
            'Data retrieved successfully.',
            $data
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
        //
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
        //
    }
}
