<?php

namespace App\Http\Controllers;

use App\Models\Batteries;
use App\Models\Drone;
use App\Models\Equipments;
use App\Models\Kits;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function __construct()
    {
        $this->Project = new Project();
        $this->Drone = new Drone();
        $this->Batteries = new Batteries();
        $this->Equipments = new Equipments();
        $this->Kits = new Kits();
    }

    public function index()
    {
        $data = [
            'project' => $this->Project->allData(),
            'drone' => $this->Drone->allData(),
            'batteries' => $this->Batteries->allData(),
            'equipments' => $this->Equipments->allData(),
            'kits' => $this->Kits->allData(),
            'title' => 'Dashboard'
        ];
        
        return view('admin.dashboard', $data);
    }

    public function showMap(Request $request)
    {

    $data = [
        'project' => $this->Project->allData(),
        'title' => 'Map'
    ];
    
    return view("admin.map",$data);

    }

    public function planMission()
    {
        $data = [
            'title' => 'Plan Mission'
        ];
        
        return view('admin.planmission', $data);
    }

}
