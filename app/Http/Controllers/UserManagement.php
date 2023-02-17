<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagement extends Controller
{
    public function __construct()
    {
        $this->User = new User();
    }

    public function index()
    {
        $data = [
            'title' => 'Data User',
            'user' => $this->User->allData(),
        ];
        return view('admin.user', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add New User'
        ];
        return view('admin.manager_create', $data);
    }

    public function insert()
    {
        Request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email',
            'address' => 'required',
            'phone' => 'required',
            'level' => 'required',
            'password' => 'required|min:3|max:255',
            // 'image' => 'required|mimes:jpeg,jpg,png|max:2048'
        ]);

        if(Request()->hasFile('image')){
            $file = Request()->image;
            $filename = uniqid() . '.' . $file->extension();
            $file->move(public_path('assets/photos/profile'), $filename);
        } else {
            $filename = 'user.jpg';
        }

        info($filename);

        $data = [
            'name' => Request()->name,
            'email' => Request()->email,
            'address' => Request()->address,
            'phone' => Request()->phone,
            'password' => Hash::make(Request()->password),
            'level' => Request()->level,
            'image' => $filename
        ];

        $this->User->insertData($data);
        return redirect()->route('user_management')->with('message', 'New User Added Successfully');
    }

    public function detail($id)
    {
        if(!$this->User->detailData($id))
        {
            abort(404);
        }
        $data = [
            'user' => $this->User->detailData($id),
            'title' => 'User Detail'
        ];

        return view('admin.user_detail', $data);
    }

    public function edit($id)
    {
        if(!$this->User->detailData($id))
        {
            abort(404);
        }
        $data = [
            'title' => 'Edit User',
            'user' => $this->User->detailData($id)
        ];
        return view('admin.user_edit', $data);
    }

    public function update($id)
    {
        Request()->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'level' => 'required',
        ]);

        if(Request()->hasFile('image')){
            $file = Request()->image;
            $filename = uniqid() . '.' . $file->extension();
            $file->move(public_path('assets/photos/profile'), $filename);
        } else {
            $filename = 'user.jpg';
        }

        $data = [
            'name' => Request()->name,
            'email' => Request()->email,
            'address' => Request()->address,
            'phone' => Request()->phone,
            'level' => Request()->level,
            'image' => $filename
        ];

        $this->User->updateData($id, $data);

        return redirect()->route('user_management')->with('message', 'User Data Updated Successfully');
    }

    public function delete($id)
    {
        $user = $this->User->detailData($id);

        if($user->image <> 'user.jpg' )
        {
            unlink(public_path('assets/photos/profile').'/'.$user->image);
        }

        $this->User->deleteData($id);
        return redirect()->route('user_management')->with('message', 'User Data Deleted Successfully');
    }

}
