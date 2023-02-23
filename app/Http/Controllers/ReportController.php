<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\Document;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Project;

class ReportController extends Controller
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

        return view('admin.report_list', $data);
    }

    public function print(Request $request)
    {
        $id = $request->id;
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
            'detail' => $this->Document->detailData($id),
            'checklist' => $checklist,
            'title' => 'ID Project',
        ];

        return view('admin.documents_download', $data);
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

        return view('admin.report', $data);
    }
}
