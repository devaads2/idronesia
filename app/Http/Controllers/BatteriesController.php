<?php

namespace App\Http\Controllers;

use App\Models\Batteries;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class BatteriesController extends Controller
{
    public function __construct()
    {
        $this->Batteries = new Batteries();
    }

    public function index()
    {
        $data = [
            'batteries' => $this->Batteries->allData(),
            'title' => 'Inventory Batteries'
        ];

        return view('admin.batteries_inventory', $data);
    }


    public function detail($id)
    {
        if(!$this->Batteries->detailData($id))
        {
            abort(404);
        }
        $data = [
            'batteries' => $this->Batteries->detailData($id),
            'title' => 'Detail Batteries'
        ];

        return view('admin.batteries_detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Batteries'
        ];
        return view('admin.batteries_create', $data);
    }

    public function insert()
    {
        Request()->validate([
            'batteries_name' => 'required|unique:batteries,batteries_name|min:3',
            'type' => 'required',
            'long_life' => 'required',
            'capacity' => 'required',
            'voltage' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:2048'
        ]);


        $file = Request()->image;
        $fileName = Request()->batteries_name . '.' . $file->extension();
        $file->move(public_path('assets/photos'), $fileName);

        $data = [
            'batteries_name' => Request()->batteries_name,
            'type' => Request()->type,
            'long_life' => Request()->long_life,
            'capacity' => Request()->capacity,
            'voltage' => Request()->voltage,
            'image' => $fileName
        ];

        $this->Batteries->insertData($data);
        return redirect()->route('batteries')->with('message', 'New Batteries Data Added Successfully');

    }

    public function edit($id)
    {
        if(!$this->Batteries->detailData($id))
        {
            abort(404);
        }
        $data = [
            'title' => 'Edit Batteries',
            'batteries' => $this->Batteries->detailData($id)
        ];
        return view('admin.batteries_edit', $data);
    }

    public function update($id)
    {
        Request()->validate([
            'batteries_name' => 'required|min:3',
            'type' => 'required',
            'long_life' => 'required',
            'capacity' => 'required',
            'voltage' => 'required',
            'image' => 'mimes:jpeg,jpg,png|max:2048'
        ]);

        if(Request()->image <> '')
        {
            $file = Request()->image;
            $fileName = Request()->batteries_name . '.' . $file->extension();
            $file->move(public_path('assets/photos'), $fileName);

            $data = [
                'batteries_name' => Request()->batteries_name,
                'type' => Request()->type,
                'long_life' => Request()->long_life,
                'capacity' => Request()->capacity,
                'voltage' => Request()->voltage,
                'image' => $fileName
        ];

        $this->Batteries->updateData($id, $data);
        }else
        {
            $data = [
                'batteries_name' => Request()->batteries_name,
                'type' => Request()->type,
                'long_life' => Request()->long_life,
                'capacity' => Request()->capacity,
                'voltage' => Request()->voltage,
        ];

        $this->Batteries->updateData($id, $data);
        }

        return redirect()->route('batteries')->with('message', 'Batteries Data Updated Successfully');

    }

    public function delete($id)
    {
        $batteries = $this->Batteries->detailData($id);

        if($batteries->image <> '')
        {
            unlink(public_path('assets/photos').'/'.$batteries->image);
        }

        $this->Batteries->deleteData($id);
        return redirect()->route('batteries')->with('message', 'Batteries Data Deleted Successfully');
    }

    public function download()
    {
        $data = [
            'batteries' => $this->Batteries->allData(),
            'title' => 'Report Inventory Batteries'
        ];

        $html =  view('admin.batteries_download', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('inventory_batteries.pdf');

    }

}
