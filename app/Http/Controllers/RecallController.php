<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RecallRequest;
use App\Repository\RecallRepository;
use App\Repository\TicketRepository;
use App\Repository\UserRepository;
use App\Repository\ServiceRepository;

class RecallController extends Controller
{
    protected $_service;
    protected $_user;
    protected $_ticket;
    protected $_recall;

    public function __construct(RecallRepository $recall, UserRepository $user, TicketRepository $ticket, ServiceRepository $service)
    {
        $this->_service = $service;
        $this->_user = $user;
        $this->_ticket = $ticket;
        $this->_recall = $recall;
    }

    public function store(RecallRequest $request)
    {
        $recall = $this->_recall->store($request->all());

        return view('ticket.show', ['ticket' => $this->_ticket->showTicketId($request->ticket_id),
        'services' => $this->_service->getPaginate(100),
        'users' => $this->_user->getPaginate(100),
        'recall' => $recall]);
    }
}
