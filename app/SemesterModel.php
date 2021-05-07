<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SemesterModel extends Model
{
    public $primaryKey = "id_semester";
    public $table = "semester";
    public $timestamps = FALSE;
}
