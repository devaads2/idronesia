<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Document extends Model
{
    use HasFactory;

    protected $guarded = ['id_projects'];

    public function detailData($id)
    {
        return DB::table('projects')
            ->select('projects.id_projects', 'projects.id_checklist_before', 'projects.id_checklist_after', 'projects.start_date', 'projects.until_date',
                'missionflights.mission_flight_name', 'projects.full_address', 'users.name',
                'drones.drone_name', 'batteries.batteries_name', 'equipments.equipments_name', 'kits.kits_name',
            )
            ->leftJoin('drones', 'drones.id', '=', 'projects.id_drone')
            ->leftJoin('batteries', 'batteries.id', '=', 'projects.id_batteries')
            ->leftJoin('equipments', 'equipments.id', '=', 'projects.id_equipments')
            ->leftJoin('kits', 'kits.id', '=', 'projects.id_kits')
            ->leftJoin('users', 'users.id', '=', 'projects.id_pilot')
            ->leftJoin('missionflights', 'missionflights.mission_flight_id', '=', 'projects.id_mission_flight')
            ->where('projects.id_projects', $id)
            ->first();
    }

    public function allData()
    {
        return DB::table('projects')->get();
    }
}
