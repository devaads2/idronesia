<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kits extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function allData()
    {
        return DB::table('kits')->get();
    }

    public function detailData($id)
    {
        return DB::table('kits')->where('id', $id)->first();
    }

    public function insertData($data)
    {
        DB::table('kits')->insert($data);
    }

    public function updateData($id, $data)
    {
        DB::table('kits')
            ->where('id', $id)
            ->update($data);
    }

    public function deleteData($id)
    {
        DB::table('kits')
            ->where('id', $id)
            ->delete();
    }

}
