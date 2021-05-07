<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentModel extends Model
{
    public $primaryKey = "id_content";
    public $table = "content";
    public $timestamps = FALSE;
}
