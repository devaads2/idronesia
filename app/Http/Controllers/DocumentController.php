<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\Document;
use Dompdf\Dompdf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
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
            $checklist = Checklist::where('id_checklists', $detail->id_checklist)->get();
        } else {
            $checklist = null;
        }

        $data = [
            'detail' => $detail,
            'checklist' => $checklist,
            'title' => 'ID Project',
        ];

        return view('admin.documents', $data);
    }

    public function print(Request $request)
    {
        $id = $request->id;
        $detail = $this->Document->detailData($id);

        if ($detail != null) {
            $checklist = Checklist::where('id_checklists', $detail->id_checklist)->get();
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
