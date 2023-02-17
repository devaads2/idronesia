<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Planmission extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function allData()
    {
        return DB::table('planmissions')->get();
    }

    public function detailData($id)
    {
        return DB::table('planmissions')->where('id', $id)->first();
    }

    public function insertData($data)
    {
        DB::table('planmissions')->insert($data);
    }

    public function updateData($id, $data)
    {
        DB::table('planmissions')
            ->where('id', $id)
            ->update($data);
    }

    public function deleteData($id)
    {
        DB::table('planmissions')
            ->where('id', $id)
            ->delete();
    }
}
