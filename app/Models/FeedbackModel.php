<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class FeedbackModel extends Model
{
    use HasUuids;
    use HasFactory;

    protected $table = "feedback";
    protected $primaryKey = 'feedback_id';
    public $incrementing = false;
    protected $keyType = 'string';
}
