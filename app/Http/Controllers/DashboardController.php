<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\TicketManagerRepository;
use App\Repository\TicketRepository;
use Auth;

class DashboardController extends Controller
{
    protected $_ticket_manager_repository;
    protected $_ticket_repository;

    public function __construct(TicketManagerRepository $ticket_manager, TicketRepository $ticket)
    {
        $this->_ticket_manager_repository = $ticket_manager;
        $this->_ticket_repository = $ticket;
    }

    public function index()
    {
        $user = Auth::user();
        return view('dashboard', ['user' => $user, 
            'ticket_service' => $this->_ticket_manager_repository->serviceTicket($user->service_id),
            'ticket_asign_to_user' => $this->_ticket_manager_repository->ticketAsignToUser($user->user_id),
            'ticket_not_resolved' => $this->_ticket_repository->ticketNotResolved($user->user_id),
            'ticket_resolved' => $this->_ticket_repository->ticketResolved($user->user_id),
            'ticket_in_processing' => $this->_ticket_repository->ticketInProcessing($user->user_id),
            'ticket_in_appointment' => $this->_ticket_repository->ticketInAppointment($user->user_id)]);
    }

}
