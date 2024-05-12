<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class SchedulingModel extends Model
{
    use HasUuids;
    use HasFactory;

    protected $table = "scheduling";
    protected $primaryKey = 'scheduling_id';
    public $incrementing = false;
    protected $keyType = 'string';
}