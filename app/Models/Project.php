<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id_projects'];

    public function allData()
    {
        return DB::table('projects')
            ->leftJoin('drones', 'drones.id', '=', 'projects.id_drone')
            ->leftJoin('batteries', 'batteries.id', '=', 'projects.id_batteries')
            ->leftJoin('equipments', 'equipments.id', '=', 'projects.id_equipments')
            ->leftJoin('kits', 'kits.id', '=', 'projects.id_kits')
            ->leftJoin('users', 'users.id', '=', 'projects.id_pilot')
            ->leftJoin('missionflights', 'missionflights.mission_flight_id', '=', 'projects.id_mission_flight')
            ->get();
    }

    public function allDataWithQuery()
    {
        return DB::table('projects')
            ->leftJoin('drones', 'drones.id', '=', 'projects.id_drone')
            ->leftJoin('batteries', 'batteries.id', '=', 'projects.id_batteries')
            ->leftJoin('equipments', 'equipments.id', '=', 'projects.id_equipments')
            ->leftJoin('kits', 'kits.id', '=', 'projects.id_kits')
            ->leftJoin('users', 'users.id', '=', 'projects.id_pilot')
            ->leftJoin('missionflights', 'missionflights.mission_flight_id', '=', 'projects.id_mission_flight');
    }

    public function detailData($id)
    {
        // return DB::table('projects')->where('id', $id)->first();

        return DB::table('projects')
            ->leftJoin('drones', 'drones.id', '=', 'projects.id_drone')
            ->leftJoin('batteries', 'batteries.id', '=', 'projects.id_batteries')
            ->leftJoin('equipments', 'equipments.id', '=', 'projects.id_equipments')
            ->leftJoin('kits', 'kits.id', '=', 'projects.id_kits')
            ->leftJoin('users', 'users.id', '=', 'projects.id_pilot')
            ->leftJoin('missionflights', 'missionflights.mission_flight_id', '=', 'projects.id_mission_flight')
            ->where('projects.id_projects', $id)
            ->first();

    }

    public function detailProjectDrone($id)
    {
        // return DB::table('projects')->where('id', $id)->first();

        return DB::table('projects')
            ->select('users.name', 'projects.*', 'drones.drone_name', 'drones.image', 'batteries.batteries_name', 'equipments.equipments_name', 'kits.kits_name', 'missionflights.mission_flight_name')
            ->leftJoin('drones', 'drones.id', '=', 'projects.id_drone')
            ->leftJoin('batteries', 'batteries.id', '=', 'projects.id_batteries')
            ->leftJoin('equipments', 'equipments.id', '=', 'projects.id_equipments')
            ->leftJoin('kits', 'kits.id', '=', 'projects.id_kits')
            ->leftJoin('users', 'users.id', '=', 'projects.id_pilot')
            ->leftJoin('missionflights', 'missionflights.mission_flight_id', '=', 'projects.id_mission_flight')
            ->where('projects.id_projects', $id)
            ->first();

    }

    public function calendarDrone($id)
    {
        return DB::table('projects')
            ->select('start_date', 'until_date', 'drones.drone_name')
            ->leftJoin('drones', 'drones.id', '=', 'projects.id_drone')
            ->where('projects.id_projects', $id)
            ->first();
    }

    public function insertData($data)
    {
        DB::table('projects')->insert($data);
    }

    public function updateData($id, $data)
    {
        DB::table('projects')
            ->where('id_projects', $id)
            ->update($data);
    }

    public function deleteData($id)
    {
        DB::table('projects')
            ->where('id_projects', $id)
            ->delete();
    }

}
