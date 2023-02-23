<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;
use App\Models\Project;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function __construct()
    {
        $this->Project = new Project();
    }

    public function index(Request $request)
    {
        $data = [
            'title' => 'Operation Calendar',
            'project' => $this->Project->allData()
        ];

        return view('admin.calendar_list', $data);
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
}
