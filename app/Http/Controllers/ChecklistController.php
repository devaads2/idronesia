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
            ->where('id_pilot','=',$id)
            ->get();

        $data = [
            'project' =>  $project,
            'title' => 'Data Checklists '
        ];

        return view('admin.checklist', $data);
    }

    public function create($id)
    {

        $title = 'Form Checklists';
        $checklist = Checklist::where('id_checklists', $id)->get();

        return view('admin.checklist_create', compact('title', 'checklist'));
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


        $this->Checklist->updateData($id, $data);
        return redirect()->route('checklist')->with('message', 'Checklist Data Updated Successfully');

    }




}
