<?php

namespace App\Http\Controllers;

use App\Models\Batteries;
use App\Models\Drone;
use App\Models\Equipments;
use App\Models\Kits;
use App\Models\Project;
use App\Models\User;
use App\Models\Checklist;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->Project = new Project();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Project',
            'project' => $this->Project->allData()
        ];
        return view('admin.project', $data);
    }

    public function detail($id)
    {
        if(!$this->Project->detailData($id))
        {
            abort(404);
        }
        $data = [
            'project' => $this->Project->detailData($id),
            'title' => 'Detail project'
        ];

        return view('admin.project_detail', $data);
    }

    public function create()
    {
        // $data = ['title' => 'Create Project'];

        $manager = User::where('level','=','manager')->get();
        $pilot = User::where('level','=','pilot')->get();

        $data = [
            'drone' => Drone::all(),
            'batteries' => Batteries::all(),
            'equipments' => Equipments::all(),
            'kits' => Kits::all(),
            'manager' => $manager,
            'pilot' => $pilot,
            'title' => 'Add Project'
        ];


        return view('admin.project_create', $data);
    }

    public function insert()
    {
        // Request()->validate([
        //     'kits_name' => 'required|unique:kits,kits_name|min:3',
        //     'type' => 'required',
        //     'description' => 'required',
        //     'image' => 'required|mimes:jpeg,jpg,png|max:2048'
        // ]);

        // $file = Request()->image;
        // $fileName = Request()->kits_name . '.' . $file->extension();
        // $file->move(public_path('assets/photos'), $fileName);

        Request()->validate([
            'id_pilot' => 'required',
            'id_manager' => 'required',
            'id_drone' => 'required',
            'id_batteries' => 'required',
            'id_equipments' => 'required',
            'id_kits' => 'required',
            'start_date' => 'required',
            'until_date' => 'required',
            'id_kits' => 'required',
            'mission_flight' => 'required',
            'latitude' => 'required'
        ], [
            'latitude.required' => 'Choose Drone Marker First !'
        ]);

        $checklist = new Checklist();
        $checklist->visual = '["-"]';
        $checklist->control = '["-"]';
        $checklist->propellers = '["-"]';
        $checklist->power = '["-"]';
        $checklist->payload = '["-"]';
        $checklist->monitor = '["-"]';
        $checklist->save();



        $data = [
            'id_checklist' => $checklist->id,
            'id_manager' => Request()->id_manager,
            'id_pilot' => Request()->id_pilot,
            'id_drone' => Request()->id_drone,
            'id_batteries' => Request()->id_batteries,
            'id_equipments' => Request()->id_equipments,
            'id_kits' => Request()->id_kits,
            'start_date' => Request()->start_date,
            'until_date' => Request()->until_date,
            'mission_flight' => Request()->mission_flight,
            'latitude' => Request()->latitude,
            'longitude' => Request()->longitude,
            'status_project' => 'Rental',
        ];

        $this->Project->insertData($data);
        return redirect()->route('project')->with('message', 'New Kits Data Added Successfully');
    }

    public function edit($id)
    {
        if(!$this->Project->detailData($id))
        {
            abort(404);
        }
        $data = [
            'drone' => Drone::all(),
            'batteries' => Batteries::all(),
            'equipments' => Equipments::all(),
            'kits' => Kits::all(),
            'title' => 'Edit Project',
            'project' => $this->Project->detailData($id)
        ];
        return view('admin.project_edit', $data);
    }

    public function update($id)
    {
        Request()->validate([
            'id_drone' => 'required',
            'id_batteries' => 'required',
            'id_equipments' => 'required',
            'id_kits' => 'required',
            'start_date' => 'required',
            'until_date' => 'required',
            'id_kits' => 'required',
        ]);

        $data = [
            'id_drone' => Request()->id_drone,
            'id_batteries' => Request()->id_batteries,
            'id_equipments' => Request()->id_equipments,
            'id_kits' => Request()->id_kits,
            'start_date' => Request()->start_date,
            'until_date' => Request()->until_date,
            'mission_flight' => Request()->mission_flight,
            'latitude' => Request()->latitude,
            'longitude' => Request()->longitude,
            'status_project' => 'test',
        ];

        $this->Project->updateData($id, $data);
        return redirect()->route('project')->with('message', 'Project Updated Successfully');

    }

    public function delete($id)
    {
        $kits = $this->Project->detailData($id);
        $this->Project->deleteData($id);
        return redirect()->route('project')->with('message', 'Project Data Deleted Successfully');
    }



}
