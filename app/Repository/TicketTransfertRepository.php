<?php

namespace App\Repository;

use App\Models\TicketTransfertModel;
use App\Models\TicketManagerModel;

class TicketTransfertRepository
{
    protected $_transfert;
    protected $_ticket_manager;

    public function __construct(TicketTransfertModel $transfert, TicketManagerModel $ticket_manager)
    {
        $this->_transfert = $transfert;
        $this->_ticket_manager = $ticket_manager;
    }

    public function save(TicketTransfertModel $transfert, Array $input)
    {
        $transfert->ticket_id_fk = $input['ticket_id'];
        $transfert->user_id_fk = $input['user_id'];
        $transfert->service_id_fk = $input['service_id'];
        $transfert->reason = $input['reason'];
        $transfert->save();
        $this->_ticket_manager->where('ticket_id', $input['ticket_id'])->update([
            "service_id" => $input['service_id'],
            "transfered_at" => now()
        ]);
    }

    public function store(Array $input)
    {
        $transfert = new $this->_transfert;

        $this->save($transfert, $input);
    }

    public function getPaginate(int $number)
    {
        return $this->_transfert->paginate($number);
    }


}