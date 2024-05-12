<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class RecallModel extends Model
{
    use HasUuids;
    use HasFactory;

    protected $table = "relance";
    protected $primaryKey = 'relance_id';
    public $incrementing = false;
    protected $keyType = 'string';
}
