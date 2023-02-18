<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ChecklistController extends Controller
{

    public function __construct()
    {
        $this->Checklist = new Checklist();
        $this->Project = new Project();
    }

    public function index()
    {
        $id = auth()->user()->id;

        $project =  DB::table('projects')
            ->leftJoin('drones', 'drones.id', '=', 'projects.id_drone')
            ->leftJoin('batteries', 'batteries.id', '=', 'projects.id_batteries')
            ->leftJoin('equipments', 'equipments.id', '=', 'projects.id_equipments')
            ->leftJoin('kits', 'kits.id', '=', 'projects.id_kits')
            ->leftJoin('checklists', 'checklists.id_checklists', '=', 'projects.id_checklist_before')
            ->where('id_pilot','=',$id)
            ->where('checklists.type','=', 'before')
            ->get();

        $data = [
            'project' =>  $project,
            'title' => 'Pre Flight Checklists '
        ];

        return view('admin.checklist', $data);
    }

    public function indexAfter()
    {
        $id = auth()->user()->id;

        $project =  DB::table('projects')
            ->leftJoin('drones', 'drones.id', '=', 'projects.id_drone')
            ->leftJoin('batteries', 'batteries.id', '=', 'projects.id_batteries')
            ->leftJoin('equipments', 'equipments.id', '=', 'projects.id_equipments')
            ->leftJoin('kits', 'kits.id', '=', 'projects.id_kits')
            ->leftJoin('checklists', 'checklists.id_checklists', '=', 'projects.id_checklist_after')
            ->where('id_pilot','=',$id)
            ->where('checklists.type','=', 'after')
            ->where('checklists.status','<>', 'waiting')
            ->get();

        $data = [
            'project' =>  $project,
            'title' => 'Post Flight Checklists '
        ];

        return view('admin.checklist', $data);
    }

    public function create($id)
    {

        $title = 'Form Checklists';
        $checklist = Checklist::where('id_checklists', $id)->get();

        return view('admin.checklist_create', compact('title', 'checklist'));
    }

    public function detail($id)
    {

        $title = 'Form Checklists';
        $checklist = Checklist::where('id_checklists', $id)->get();

        return view('admin.checklist_detail', compact('title', 'checklist'));
    }

    public function insert($id)
    {
        $data = [
            'visual' => json_encode(Request()->visual),
            'control' => json_encode(Request()->control),
            'propellers' => json_encode(Request()->propellers),
            'power' => json_encode(Request()->power),
            'payload' => json_encode(Request()->payload),
            'monitor' => json_encode(Request()->monitor),
            'status' => 'done'
        ];

        if($data['visual'] === 'null')
        {
            $data['visual'] = '["-"]';
        }
        if($data['control'] === 'null')
        {
            $data['control'] = '["-"]';
        }
        if($data['propellers'] === 'null')
        {
            $data['propellers'] = '["-"]';
        }
        if($data['power'] === 'null')
        {
            $data['power'] = '["-"]';
        }
        if($data['payload'] === 'null')
        {
            $data['payload'] = '["-"]';
        }
        if($data['monitor'] === 'null')
        {
            $data['monitor'] = '["-"]';
        }

        if(Request()->type == 'before') {
            $project =  DB::table('projects')
                ->where('id_checklist_before', '=', $id)
                ->first();

            $idChecklistAfter = $project->id_checklist_after;

            $checklistData = [
                'status' => 'ready'
            ];

            $this->Checklist->updateData($idChecklistAfter, $checklistData);

            $projectData = [
                'status_project' => 'On Flight'
            ];
            $this->Project->updateData($project->id_projects, $projectData);
            $this->Checklist->updateData($id, $data);

            return redirect()->route('checklist')->with('message', 'Checklist Data Updated Successfully');
        } else {
            Request()->validate([
                'image' => 'required|mimes:jpeg,jpg,png|max:2048'
            ], [
                'image.required' => 'Please select image !'
            ]);
            info(Request());

            $file = Request()->image;
            $filename = uniqid() . '.' . $file->extension();
            $file->move(public_path('assets/photos'), $filename);
            $data['image'] = $filename;

            $project =  DB::table('projects')
                ->where('id_checklist_after', '=', $id)
                ->first();

            $projectData = [
                'status_project' => 'Complete'
            ];
            $this->Project->updateData($project->id_projects, $projectData);
            $this->Checklist->updateData($id, $data);

            return redirect()->route('checklistAfter')->with('message', 'Checklist Data Updated Successfully');
        }
    }




}
