<?php

namespace App\Http\Controllers;

use App\Models\Drone;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class DroneController extends Controller
{

    public function __construct()
    {
        $this->Drone = new Drone();
    }

    public function index()
    {
        $data = [
            'drone' => $this->Drone->allData(),
            'title' => 'Inventory Drone'
        ];

        return view('admin.drone_inventory', $data);
    }

    public function detail($id)
    {
        if(!$this->Drone->detailData($id))
        {
            abort(404);
        }
        $data = [
            'drone' => $this->Drone->detailData($id),
            'title' => 'Detail Drone'
        ];

        return view('admin.drone_detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Drone'
        ];
        return view('admin.drone_create', $data);
    }

    public function insert()
    {
        Request()->validate([
            'drone_name' => 'required|min:3',
            'max_flying_alt' => 'required',
            'adjustable_angel_camera' => 'required',
            'eis' => 'required',
            'control_distance' => 'required',
            'wifi_transmission' => 'required',
            'video_res' => 'required',
            'photo_res' => 'required',
            'video_res' => 'required',
            'product_weight' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:2048'
        ]);

        // ,[
        //     'name.required' => 'Field name harus diisi !'
        // ]

        $file = Request()->image;
        $fileName = Request()->drone_name . '.' . $file->extension();
        $file->move(public_path('assets/photos'), $fileName);

        $data = [
            'drone_name' => Request()->drone_name,
            'max_flying_alt' => Request()->max_flying_alt,
            'adjustable_angel_camera' => Request()->adjustable_angel_camera,
            'eis' => Request()->eis,
            'control_distance' => Request()->control_distance,
            'wifi_transmission' => Request()->wifi_transmission,
            'video_res' => Request()->video_res,
            'photo_res' => Request()->photo_res,
            'product_weight' => Request()->product_weight,
            'image' => $fileName
        ];

        $this->Drone->insertData($data);
        return redirect()->route('drone')->with('message', 'New Drone Data Added Successfully');
    }

    public function edit($id)
    {
        if(!$this->Drone->detailData($id))
        {
            abort(404);
        }
        $data = [
            'title' => 'Edit Drone',
            'drone' => $this->Drone->detailData($id)
        ];
        return view('admin.drone_edit', $data);
    }

    public function update($id)
    {
        Request()->validate([
            'drone_name' => 'required|min:3',
            'max_flying_alt' => 'required',
            'adjustable_angel_camera' => 'required',
            'eis' => 'required',
            'control_distance' => 'required',
            'wifi_transmission' => 'required',
            'video_res' => 'required',
            'photo_res' => 'required',
            'video_res' => 'required',
            'product_weight' => 'required',
            'image' => 'mimes:jpeg,jpg,png|max:2048'
        ]);

        if(Request()->image <> '')
        {
            $file = Request()->image;
            $fileName = Request()->drone_name . '.' . $file->extension();
            $file->move(public_path('assets/photos'), $fileName);

            $data = [
                'drone_name' => Request()->drone_name,
                'max_flying_alt' => Request()->max_flying_alt,
                'adjustable_angel_camera' => Request()->adjustable_angel_camera,
                'eis' => Request()->eis,
                'control_distance' => Request()->control_distance,
                'wifi_transmission' => Request()->wifi_transmission,
                'video_res' => Request()->video_res,
                'photo_res' => Request()->photo_res,
                'product_weight' => Request()->product_weight,
                'image' => $fileName
            ];

            $this->Drone->updateData($id, $data);

        }else
        {
            $data = [
                'drone_name' => Request()->drone_name,
                'max_flying_alt' => Request()->max_flying_alt,
                'adjustable_angel_camera' => Request()->adjustable_angel_camera,
                'eis' => Request()->eis,
                'control_distance' => Request()->control_distance,
                'wifi_transmission' => Request()->wifi_transmission,
                'video_res' => Request()->video_res,
                'photo_res' => Request()->photo_res,
                'product_weight' => Request()->product_weight,
            ];

            $this->Drone->updateData($id, $data);
        }


        return redirect()->route('drone')->with('message', 'Drone Data Updated Successfully');
    }

    public function delete($id)
    {
        $drone = $this->Drone->detailData($id);

        if($drone->image <> '')
        {
            unlink(public_path('assets/photos').'/'.$drone->image);
        }

        $this->Drone->deleteData($id);
        return redirect()->route('drone')->with('message', 'Drone Data Deleted Successfully');
    }


    public function download()
    {
        $data = [
            'drone' => $this->Drone->allData(),
            'title' => 'Report Inventory Drone'
        ];

        $html = view('admin.drone_download', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('inventory_drone.pdf');

    }

}
