<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\Document;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->Document = new Document();
        $this->Checklist = new Checklist();
        $this->Project = new Project();
    }

    public function index(Request $request)
    {
        $data = [
            'title' => 'Report',
            'project' => $this->Project->allData()
        ];

        return view('admin.document_list', $data);
    }

    public function getDetail($id) {
        $detail = $this->Document->detailData($id);

        if ($detail != null) {
            $checklist = Checklist::where('id_checklists', $detail->id_checklist_after)->get();
            if($checklist[0]->status <> 'done') {
                $checklist = Checklist::where('id_checklists', $detail->id_checklist_before)->get();
            }
        } else {
            $checklist = null;
        }

        $data = [
            'detail' => $detail,
            'checklist' => $checklist,
            'title' => 'ID Project',
            'print' => true,
        ];

        return view('admin.documents', $data);
    }
}
