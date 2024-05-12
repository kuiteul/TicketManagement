<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TicketTransfertModel extends Model
{
    use HasUuids;
    use HasFactory;

    protected $table = "ticket_transfert";
    protected $primaryKey = 'ticket_transfert_id';
    public $incrementing = false;
    protected $keyType = 'string';
}
