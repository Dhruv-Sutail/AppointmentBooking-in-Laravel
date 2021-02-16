<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    protected $table ='_appoitments';
    protected $fillable=['civil_id','client_name','phone','department','sub_department','date','email'];
}
