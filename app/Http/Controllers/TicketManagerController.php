<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OpenTicketRequest;
use App\Repository\TicketRepository;
use App\Repository\UserRepository;
use App\Repository\ServiceRepository;
use App\Repository\TicketManagerRepository;
use Auth;

class TicketManagerController
{

    protected $_ticket_manager;
    protected $_user;
    protected $_ticket;
    protected $_service;

    public function __construct(TicketManagerRepository $ticket_manager, UserRepository $user, TicketRepository $ticket, ServiceRepository $service)
    {
        $this->_ticket_manager = $ticket_manager;
        $this->_user = $user;
        $this->_ticket = $ticket;
        $this->_service = $service;
    }

    /**
     * get all
     */
    public function getServiceTicket()
    {
        return view('ticket.ticketService', ['ticket_service' => $this->_ticket_manager->getServiceTicket(Auth::user()->service_id)]);
    }

    /**
     * Retrieve all tickets who has been asigned to user
     * for treatment
     */
    public function ticketAssignToUser()
    {
        $user_auth = Auth::user();

        return view('ticket.asignToUser', ['asign_to_user' => $this->_ticket_manager->getTicketAsignToUser($user_auth->user_id),
                        'users' => $this->_user->getPaginate(100)]);
    }

    public function asignToMe(OpenTicketRequest $request)
    {
        $this->_ticket_manager->asignTicketToMe($request->all());
        
        return view('ticket.show', ['ticket' => $this->_ticket->showTicketId($request->ticket_id),
                        'services' => $this->_service->getPaginate(100),
                        'users' => $this->_user->getPaginate(100)]);
    }

}