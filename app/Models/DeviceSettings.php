<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class DeviceSettings extends Model
{
    use HasFactory;

    public $connection = 'mongodb';

    protected $dates = ['created_at'];

    protected $guarded = ['_id'];
}
