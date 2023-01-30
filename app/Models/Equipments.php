<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Equipments extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function allData()
    {
        return DB::table('equipments')->get();
    }

    public function detailData($id)
    {
        return DB::table('equipments')->where('id', $id)->first();
    }

    public function insertData($data)
    {
        DB::table('equipments')->insert($data);
    }

    public function updateData($id, $data)
    {
        DB::table('equipments')
            ->where('id', $id)
            ->update($data);
    }

    public function deleteData($id)
    {
        DB::table('equipments')
            ->where('id', $id)
            ->delete();
    }

}
