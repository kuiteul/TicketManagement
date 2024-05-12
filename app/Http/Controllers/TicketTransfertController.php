<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TicketTransfertRequest;
use App\Repository\TicketTransfertRepository;
use App\Repository\UserRepository;
use App\Repository\ServiceRepository;
use App\Repository\TicketManagerRepository;
use Auth;

class TicketTransfertController extends Controller
{
    protected $_transfert;
    protected $_ticket_manager;

    public function __construct(TicketTransfertRepository $transfert, TicketManagerRepository $ticket_manager)
    {
        $this->_transfert = $transfert;
        $this->_ticket_manager = $ticket_manager;
    }

    public function store(TicketTransfertRequest $request)
    {
        $this->_transfert->store($request->all());

        return view('ticket.ticketService', ['ticket_service' => $this->_ticket_manager->getServiceTicket(Auth::user()->service_id)]);
    }
}
