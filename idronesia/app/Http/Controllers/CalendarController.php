<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Dompdf\Dompdf;

class CalendarController extends Controller
{
    public function __construct()
    {
        $this->Project = new Project();
    }

    public function index(Request $request)
    {
        $id = $request->id;
        $calendar = $this->Project->calendarDrone($id);
        // dd($calendar);

        if(isset($calendar)){
            $rangeDate = $this->dateRange($calendar->start_date, $calendar->until_date);
        }else{
            $rangeDate = [];
        }

        $data = [
            'rangeDate' => $rangeDate,
            'droneName' => $calendar->drone_name ?? '',
            'title' => 'Operation Calendar',
            'id_drone'    => $id
        ];
        // dd($data);
        // 
        return view('admin.calendar_operation', $data);
    }

    public function download($id)
    {
        // $data = [
        //     'detail' => $this->Project->detailProjectDrone($id),
        //     'title' => 'Report Flight Drone IDRONESIA'
        // ];

        $calendar = $this->Project->calendarDrone($id);
        // dd($calendar);

        if(isset($calendar)){
            $rangeDate = $this->dateRange($calendar->start_date, $calendar->until_date);
        }else{
            $rangeDate = [];
        }

        $data = [
            'rangeDate' => $rangeDate,
            'droneName' => $calendar->drone_name ?? '',
            'title' => 'Operation Calendar',
            'id_drone'    => $id
        ];

        $html =  view('admin.calendar_download', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Report_Operation_Calender.pdf');

    }

    function dateRange($first, $last, $step = '+1 day', $output_format = 'Y-m-d')
    {
        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);

        while ($current <= $last) {

            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }

        return $dates;
    }
}
