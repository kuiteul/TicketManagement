<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Facades\DB;

class TicketManagerModel extends Model
{
    use HasUuids;
    use HasFactory;

    protected $table = "ticketmanager";
    protected $primaryKey = 'ticket_manager_id';
    public $incrementing = false;
    protected $updated_at = false;
    protected $created_at = false;
    protected $keyType = 'string';
    
    
}
