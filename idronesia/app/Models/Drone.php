<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Drone extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function allData()
    {
        return DB::table('drones')->get();
    }

    public function detailData($id)
    {
        return DB::table('drones')->where('id', $id)->first();
    }

    public function insertData($data)
    {
        DB::table('drones')->insert($data);
    }

    public function updateData($id, $data)
    {
        DB::table('drones')
            ->where('id', $id)
            ->update($data);
    }

    public function deleteData($id)
    {
        DB::table('drones')
            ->where('id', $id)
            ->delete();
    }

}
