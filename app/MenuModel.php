<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    public $primaryKey = "id_list";
    public $table = "list_menu";
    public $timestamps = FALSE;
}
