<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatakuliahModel extends Model
{
    public $primaryKey = "id_pekuliahan";
    public $table = "perkuliahan";
    public $timestamps = FALSE;
}
