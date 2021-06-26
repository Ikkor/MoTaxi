<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ride extends Model
{
    use HasFactory;
    protected $primaryKey='ride_id';
    protected $fillable=['from_loc', 'to_loc', 'time_in','time_out','client_id','driver_id','service_type','distance','pay','vehicle','status'];
    public $timestamps = false;
}
