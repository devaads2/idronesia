<?php

namespace App\Http\Controllers;

use App\Models\Batteries;
use App\Models\Drone;
use App\Models\Equipments;
use App\Models\Kits;
use App\Models\Missionflight;
use App\Models\Project;
use App\Models\User;
use App\Models\Checklist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'drone' => Drone::all()->where('status', '=', 'available'),
            'batteries' => Batteries::all()->where('status', '=', 'available'),
            'equipments' => Equipments::all()->where('status', '=', 'available'),
            'kits' => Kits::all()->where('status', '=', 'available'),
            'missionflight' => Missionflight::all(),
            'manager' => $manager,
            'pilot' => $pilot,
            'title' => 'Add Project'
        ];


        return view('admin.project_create', $data);
    }

    public function insert()
    {
        Request()->validate([
            'id_pilot' => 'required',
            'id_manager' => 'required',
            'id_drone' => 'required',
            'id_batteries' => 'required',
            'id_equipments' => 'required',
            'id_kits' => 'required',
            'start_date' => 'required|after:yesterday',
            'until_date' => 'required|after:start_date',
            'id_kits' => 'required',
            'id_mission_flight' => 'required',
            'latitude' => 'required'
        ], [
            'latitude.required' => 'Choose Drone Marker First !'
        ]);

        $checklistBefore = new Checklist();
        $checklistBefore->visual = '["-"]';
        $checklistBefore->control = '["-"]';
        $checklistBefore->propellers = '["-"]';
        $checklistBefore->power = '["-"]';
        $checklistBefore->payload = '["-"]';
        $checklistBefore->monitor = '["-"]';
        $checklistBefore->image = 'null';
        $checklistBefore->status = 'ready';
        $checklistBefore->type = 'before';
        $checklistBefore->save();

        $checklistAfter = new Checklist();
        $checklistAfter->visual = '["-"]';
        $checklistAfter->control = '["-"]';
        $checklistAfter->propellers = '["-"]';
        $checklistAfter->power = '["-"]';
        $checklistAfter->payload = '["-"]';
        $checklistAfter->monitor = '["-"]';
        $checklistAfter->image = 'null';
        $checklistAfter->status = 'waiting';
        $checklistAfter->type = 'after';
        $checklistAfter->save();

        $data = [
            'id_checklist_before' => $checklistBefore->id,
            'id_checklist_after' => $checklistAfter->id,
            'id_manager' => Request()->id_manager,
            'id_pilot' => Request()->id_pilot,
            'id_drone' => Request()->id_drone,
            'id_batteries' => Request()->id_batteries,
            'id_equipments' => Request()->id_equipments,
            'id_kits' => Request()->id_kits,
            'start_date' => Request()->start_date,
            'until_date' => Request()->until_date,
            'id_mission_flight' => Request()->id_mission_flight,
            'latitude' => Request()->latitude,
            'longitude' => Request()->longitude,
            'full_address' => Request()->full_address,
            'status_project' => 'On Schedule',
        ];

        Drone::where('id', '=', Request()->id_drone)->update(['status' => 'in_used']);
        Equipments::where('id', '=', Request()->id_equipments)->update(['status' => 'in_used']);
        Batteries::where('id', '=', Request()->id_batteries)->update(['status' => 'in_used']);
        Kits::where('id', '=', Request()->id_kits)->update(['status' => 'in_used']);

        $this->Project->insertData($data);
        return redirect()->route('project')->with('message', 'New Project Data Added Successfully');
    }

    public function edit($id)
    {
        if(!$this->Project->detailData($id))
        {
            abort(404);
        }

        $drone = Drone::where('id',$this->Project->detailData($id)->id_drone )->orWhere('status', 'available')->get();
        $equipment = Equipments::where('id',$this->Project->detailData($id)->id_equipments )->orWhere('status', 'available')->get();
        $batteries = Batteries::where('id',$this->Project->detailData($id)->id_batteries )->orWhere('status', 'available')->get();
        $kits = Kits::where('id',$this->Project->detailData($id)->id_kits )->orWhere('status', 'available')->get();

        $data = [
            'drone' => $drone,
            'batteries' => $batteries,
            'equipments' => $equipment,
            'kits' => $kits,
            'missionflight' => Missionflight::all(),
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
            'latitude' => 'required',
            'longitude' => 'required',
            'full_address' => 'required',
        ]);

        $currentProject = $this->Project->detailData($id);

        $data = [
            'id_drone' => Request()->id_drone,
            'id_batteries' => Request()->id_batteries,
            'id_equipments' => Request()->id_equipments,
            'id_kits' => Request()->id_kits,
            'start_date' => Request()->start_date,
            'until_date' => Request()->until_date,
            'id_mission_flight' => Request()->id_mission_flight,
            'latitude' => Request()->latitude,
            'longitude' => Request()->longitude,
            'full_address' => Request()->full_address,
        ];

        Drone::where('id', '=', $currentProject->id_drone)->update(['status' => 'available']);
        Equipments::where('id', '=', $currentProject->id_equipments)->update(['status' => 'available']);
        Batteries::where('id', '=', $currentProject->id_batteries)->update(['status' => 'available']);
        Kits::where('id', '=', $currentProject->id_kits)->update(['status' => 'available']);

        Drone::where('id', '=', Request()->id_drone)->update(['status' => 'in_used']);
        Equipments::where('id', '=', Request()->id_equipments)->update(['status' => 'in_used']);
        Batteries::where('id', '=', Request()->id_batteries)->update(['status' => 'in_used']);
        Kits::where('id', '=', Request()->id_kits)->update(['status' => 'in_used']);

        $this->Project->updateData($id, $data);
        return redirect()->route('project')->with('message', 'Project Updated Successfully');

    }

    public function delete($id)
    {
        $kits = $this->Project->detailData($id);
        $this->Project->deleteData($id);
        return redirect()->route('project')->with('message', 'Project Data Deleted Successfully');
    }

    public function finalizeProject(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        Project::where('id_projects', $id)->update(['status_project' => $status]);

        $project =  DB::table('projects')
            ->where('id_projects', '=', $id)
            ->first();

        Drone::where('id', '=', $project->id_drone)->update(['status' => 'available']);
        Equipments::where('id', '=', $project->id_equipments)->update(['status' => 'available']);
        Batteries::where('id', '=', $project->id_batteries)->update(['status' => 'available']);
        Kits::where('id', '=', $project->id_kits)->update(['status' => 'available']);

        return response()->json(['success' => 'success'], 200);
    }

}
