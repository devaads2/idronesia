<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Batteries extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function allData()
    {
        return DB::table('batteries')->get();
    }


    public function detailData($id)
    {
        return DB::table('batteries')->where('id', $id)->first();
    }

    public function insertData($data)
    {
        DB::table('batteries')->insert($data);
    }

    public function updateData($id, $data)
    {
        DB::table('batteries')
            ->where('id', $id)
            ->update($data);
    }

    public function deleteData($id)
    {
        DB::table('batteries')
            ->where('id', $id)
            ->delete();
    }

}
