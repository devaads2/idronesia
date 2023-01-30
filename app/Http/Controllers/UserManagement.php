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

        // $file = Request()->image;
        // $fileName = Request()->kits_name . '.' . $file->extension();
        // $file->move(public_path('assets/photos'), $fileName);

        $data = [
            'name' => Request()->name,
            'email' => Request()->email,
            'address' => Request()->address,
            'phone' => Request()->phone,
            'password' => Hash::make(Request()->password),
            'level' => Request()->level,
            'image' => 'user.jpg'
        ];

        $this->User->insertData($data);
        return redirect()->route('user_management')->with('message', 'New User Added Successfully');
    }

}
