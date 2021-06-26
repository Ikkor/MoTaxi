<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class driver_location extends Model
{
    use HasFactory;
    protected $primaryKey='driver_id';
    protected $fillable=['location'];
    public $timestamps = false;
}
