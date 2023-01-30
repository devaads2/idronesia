<?php

namespace App\Http\Controllers;

use App\Models\Kits;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class KitsController extends Controller
{
    public function __construct()
    {
        $this->Kits = new Kits();
    }

    public function index()
    {
        $data = [
            'kits' => $this->Kits->allData(),
            'title' => 'Inventory Kits'
        ];
        
        return view('admin.kits_inventory', $data);
    }

    public function detail($id)
    {
        if(!$this->Kits->detailData($id))
        {
            abort(404);
        }
        $data = [
            'kits' => $this->Kits->detailData($id),
            'title' => 'Detail Kits'
        ];
        
        return view('admin.kits_detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Kits'
        ];
        return view('admin.kits_create', $data);
    }

    public function insert()
    {
        Request()->validate([
            'kits_name' => 'required|unique:kits,kits_name|min:3',
            'type' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:2048'
        ]);

        $file = Request()->image;
        $fileName = Request()->kits_name . '.' . $file->extension();
        $file->move(public_path('assets/photos'), $fileName);

        $data = [
            'kits_name' => Request()->kits_name,
            'type' => Request()->type,
            'description' => Request()->description,
            'image' => $fileName
        ];

        $this->Kits->insertData($data);
        return redirect()->route('kits')->with('message', 'New Kits Data Added Successfully');
    }

    public function edit($id)
    {
        if(!$this->Kits->detailData($id))
        {
            abort(404);
        }
        $data = [
            'title' => 'Edit Kits',
            'kits' => $this->Kits->detailData($id)
        ];
        return view('admin.kits_edit', $data);
    }

    public function update($id)
    {
        Request()->validate([
            'kits_name' => 'required|min:3',
            'type' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpeg,jpg,png|max:2048'
        ]);

        if(Request()->image <> '')
        {
            $file = Request()->image;
            $fileName = Request()->kits_name . '.' . $file->extension();
            $file->move(public_path('assets/photos'), $fileName);

            $data = [
                'kits_name' => Request()->kits_name,
                'type' => Request()->type,
                'description' => Request()->description,
                'image' => $fileName
        ];
        $this->Kits->updateData($id, $data);
        }else
        {
            $data = [
                'kits_name' => Request()->kits_name,
                'type' => Request()->type,
                'description' => Request()->description,
        ];
            $this->Kits->updateData($id, $data);
        }
        return redirect()->route('kits')->with('message', 'New Kits Data Added Successfully');
    }

    public function delete($id)
    {
        $kits = $this->Kits->detailData($id);

        if($kits->image <> '')
        {
            unlink(public_path('assets/photos').'/'.$kits->image);
        }

        $this->Kits->deleteData($id);
        return redirect()->route('kits')->with('message', 'Kits Data Deleted Successfully');
    }

    public function download()
    {
        $data = [
            'kits' => $this->Kits->allData(),
            'title' => 'Report Inventory Kits'
        ];

        $html =  view('admin.kits_download', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('inventory_kits.pdf');

    }

}
