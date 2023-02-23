<?php

namespace App\Http\Controllers;

use App\Models\Missionflight;

class MissionFlightController extends Controller
{
    public function __construct()
    {
        $this->Missionflight = new Missionflight();
    }

    public function index()
    {
        $data = [
            'missionflights' => $this->Missionflight->allData(),
            'title' => 'Mission Flight'
        ];

        return view('admin.mission_flight', $data);
    }

    public function insert()
    {
        Request()->validate([
            'mission_flight_name' => 'required',
        ]);

        $data = [
            'mission_flight_name' => Request()->mission_flight_name,
        ];

        $this->Missionflight->insertData($data);
        return redirect()->route('missionflight')->with('message', 'New Mission Flight Added');
    }

    public function edit($id)
    {
        $missionFlight = $this->Missionflight->detailData($id);
        return response()->json($missionFlight);
    }

    public function update($id)
    {
        Request()->validate([
            'mission_flight_name' => 'required',
        ]);

        $data = [
            'mission_flight_name' => Request()->mission_flight_name,
        ];

        $this->Missionflight->updateData($id, $data);

        return redirect()->route('missionflight')->with('message', 'Mission Flight Data Updated Successfully');

    }

    public function delete($id)
    {
        $this->Missionflight->deleteData($id);
        return redirect()->route('missionflight')->with('message', 'Mission Flight Data Deleted Successfully');
    }
}
