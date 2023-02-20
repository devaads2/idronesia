<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\Document;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->Document = new Document();
        $this->Checklist = new Checklist();
    }

    public function index(Request $request)
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
            'detail' => $detail,
            'checklist' => $checklist,
            'title' => 'ID Project',
            'print' => true,
        ];

        return view('admin.documents', $data);
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
}
