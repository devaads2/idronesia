<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Checklist extends Model
{
    use HasFactory;

    public function detailData($id)
    {
        return DB::table('checklists')->where('id_checklists', $id)->first();
    }

    public function updateData($id, $data)
    {
        DB::table('checklists')
            ->where('id_checklists', $id)
            ->update($data);
    }

}
