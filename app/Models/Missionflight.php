<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Missionflight extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function allData()
    {
        return DB::table('missionflights')->get();
    }


    public function detailData($id)
    {
        return DB::table('missionflights')->where('mission_flight_id', $id)->first();
    }

    public function insertData($data)
    {
        DB::table('missionflights')->insert($data);
    }

    public function updateData($id, $data)
    {
        DB::table('missionflights')
            ->where('mission_flight_id', $id)
            ->update($data);
    }

    public function deleteData($id)
    {
        DB::table('missionflights')
            ->where('mission_flight_id', $id)
            ->delete();
    }

}
