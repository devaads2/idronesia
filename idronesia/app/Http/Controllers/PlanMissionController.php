<?php

namespace App\Http\Controllers;

use App\Models\Drone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\Project;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlanMissionController extends Controller
{

    public function __construct()
    {
        $this->Project = new Project();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of($this->Project->allData());
        }

        $data = [
            'title' => 'Plan Mission',
            'project' => $this->Project->allData()
        ];
        return view('admin.planmission', $data);
    }

    public function getPlanMission(Request $request)
    {
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


}
