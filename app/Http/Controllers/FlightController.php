<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;

class FlightController extends Controller
{
    public function __construct()
    {
        $this->Project = new Project();
    }

    public function index(Request $request)
    {
        $data = [
            'title' => 'Flight',
            'project' => $this->Project->allData()
        ];

        return view('admin.flight_list', $data);
    }

    public function getFlight(Request $request)
    {
        $id = $request->input('id') ?? '';
        $data = [
            'detail' => $this->Project->detailProjectDrone($id),
            'title' => 'Flight',
            'id_drone'    => $id
        ];

        return view('admin.flight_schedule', $data);
    }

    public function download($id)
    {
        $data = [
            'detail' => $this->Project->detailProjectDrone($id),
            'title' => 'Report Flight Drone IDRONESIA'
        ];

        $html =  view('admin.flight_download', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Report_Flight.pdf');

    }

public function getList() {
    $user = Auth::user();
    $data = $this->Project->allDataWithQuery();

    if ($user->level == "pilot") {
        $data = $data->where('id_pilot', '=', $user->id)->get();
    } else if ($user->level == "manager") {
        $data = $data->where('id_manager', '=', $user->id)->get();
    } else {
        $data = $data->get();
    }
    return response()->json(['data' => $data]);
}

public function getDetail($id) {
    $data = [
        'detail' => $this->Project->detailProjectDrone($id),
        'title' => 'Flight',
        'id_drone'    => $id
    ];

    return view('admin.flight_schedule', $data);
}
}
