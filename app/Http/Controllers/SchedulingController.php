<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SchedulingRequest;
use App\Repository\SchedulingRepository;
use App\Repository\TicketManagerRepository;
use App\Repository\TicketRepository;
use Auth;

class SchedulingController extends Controller
{
    protected $_schedule;
    protected $_ticket_manager;
    protected $_ticket;

    public function __construct(SchedulingRepository $schedule, TicketManagerRepository $ticket_manager, TicketRepository $ticket)
    {
        $this->_schedule = $schedule;
        $this->_ticket_manager = $ticket_manager;
        $this->_ticket = $ticket;
    }

    public function store(SchedulingRequest $request)
    {
        $this->_schedule->store($request->all());
        $this->_ticket->scheduleTicket($request->ticket_id);

        return view('ticket.ticketService', ['ticket_service' => $this->_ticket_manager->getServiceTicket(Auth::user()->service_id)]);
        
    }

    public function show(string $scheduling_id)
    {
        return view('scheduled.show', ['scheduled' => $this->_schedule->getId($scheduling_id)]);
    }

    public function update(SchedulingRequest $request, string $scheduling_id)
    {
        return view('scheduled.update', ['scheduled' => $this->_schedule->update($scheduling_id, $request->all())]);
    }
}
