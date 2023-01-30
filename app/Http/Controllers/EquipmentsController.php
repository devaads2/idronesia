<?php

namespace App\Http\Controllers;

use App\Models\Equipments;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class EquipmentsController extends Controller
{
    public function __construct()
    {
        $this->Equipments = new Equipments();
    }

    public function index()
    {
        $data = [
            'equipments' => $this->Equipments->allData(),
            'title' => 'Inventory Equipments'
        ];
        
        return view('admin.equipments_inventory', $data);
    }


    public function detail($id)
    {
        if(!$this->Equipments->detailData($id))
        {
            abort(404);
        }
        $data = [
            'equipments' => $this->Equipments->detailData($id),
            'title' => 'Detail Equipments'
        ];
        
        return view('admin.equipments_detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Equipments'
        ];
        return view('admin.equipments_create', $data);
    }

    public function insert()
    {
        Request()->validate([
            'equipments_name' => 'required|unique:equipments,equipments_name|min:3',
            'type' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:2048'
        ]);


        $file = Request()->image;
        $fileName = Request()->equipments_name . '.' . $file->extension();
        $file->move(public_path('assets/photos'), $fileName);

        $data = [
            'equipments_name' => Request()->equipments_name,
            'type' => Request()->type,
            'description' => Request()->description,
            'image' => $fileName
        ];

        $this->Equipments->insertData($data);
        return redirect()->route('equipments')->with('message', 'New Equipments Data Added Successfully');
    }

    public function edit($id)
    {
        if(!$this->Equipments->detailData($id))
        {
            abort(404);
        }
        $data = [
            'title' => 'Edit Equipments',
            'equipments' => $this->Equipments->detailData($id)
        ];
        return view('admin.equipments_edit', $data);
    }

    public function update($id)
    {
        Request()->validate([
            'equipments_name' => 'required|min:3',
            'type' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpeg,jpg,png|max:2048'
        ]);

        if(Request()->image <> '')
        {
            $file = Request()->image;
            $fileName = Request()->equipments_name . '.' . $file->extension();
            $file->move(public_path('assets/photos'), $fileName);
    
            $data = [
                'equipments_name' => Request()->equipments_name,
                'type' => Request()->type,
                'description' => Request()->description,
                'image' => $fileName
            ];
    
            $this->Equipments->updateData($id, $data);
        }else
        {
            $data = [
                'equipments_name' => Request()->equipments_name,
                'type' => Request()->type,
                'description' => Request()->description,
            ];
    
            $this->Equipments->updateData($id, $data);
        }
        return redirect()->route('equipments')->with('message', 'Equipments Data Updated Successfully');
    }

    public function delete($id)
    {
        $equipments = $this->Equipments->detailData($id);

        if($equipments->image <> '')
        {
            unlink(public_path('assets/photos').'/'.$equipments->image);
        }

        $this->Equipments->deleteData($id);
        return redirect()->route('equipments')->with('message', 'Equipments Data Deleted Successfully');
    }

    public function download()
    {
        $data = [
            'equipments' => $this->Equipments->allData(),
            'title' => 'Report Inventory Equipments'
        ];

        $html =  view('admin.equipments_download', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('inventory_equipments.pdf');

    }
    

}
