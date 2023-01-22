<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Dompdf\Dompdf;

class FlightController extends Controller
{
    public function __construct()
    {
        $this->Project = new Project();
    }

    public function index(Request $request)
    {
        $id = $request->id;
        $data = [
            'detail' => $this->Project->detailProjectDrone($id),
            'title' => 'Flight',
            'id_drone'    => $id
        ];
        
        return view('admin.flight_schedule', $data);
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
}
