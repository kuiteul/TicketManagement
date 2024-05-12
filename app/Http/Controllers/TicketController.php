<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TicketRequest;
use App\Http\Requests\OpenTicketRequest;
use App\Http\Requests\ValidateResultRequest;
use App\Repository\TicketRepository;
use App\Repository\UserRepository;
use App\Repository\ServiceRepository;
use App\Repository\TicketManagerRepository;
use App\Repository\SchedulingRepository;
use Auth;


class TicketController extends Controller
{
    protected $_user_repository;
    protected $_ticket_repository;
    protected $_ticket_manager_repository;
    protected $_service_repository;
    protected $_scheduling_repository;

    public function __construct(ServiceRepository $service, TicketRepository $ticket, TicketManagerRepository $ticket_manager, 
                UserRepository $user, SchedulingRepository $scheduling)
    {
        $this->_service_repository = $service;
        $this->_ticket_repository = $ticket;
        $this->_ticket_manager_repository = $ticket_manager;
        $this->_user_repository = $user;
        $this->_scheduling_repository = $scheduling;

    }
    /**
     * 
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->user_id;

       return view('ticket.index', ['ticket' => $this->_ticket_repository->ticketBelongToUser($user_id),
                        'service' => $this->_service_repository->getPaginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('ticket.create', ['service' => $this->_service_repository->getPaginate(20)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        $track_id = $this->_ticket_repository->store($request->all()); //This function return track_id record
        $getTicket_id = $this->_ticket_repository->getTicketByTrackId($track_id); //This function return an array of object
        $ticket_id = Array();
        //This loop retrieve the value of tikcet_id in the array of object
        foreach($getTicket_id as $item)
        {
            $ticket_id = $item->ticket_id;
        }

        $ticket_manager_request = ['ticket_id' => $ticket_id, 'service_id' => $request->service_id];
        
        $this->_ticket_manager_repository->store($ticket_manager_request);

        $user_id = Auth::user()->user_id;

        return view('ticket.index', ['ticket' => $this->_ticket_repository->ticketBelongToUser($user_id)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $ticket_id)
    {
        $ticket_manager_id = $this->_ticket_manager_repository->getTicketManagerId($ticket_id);
        $manager_id = $ticket_manager_id->all();
        return view('ticket.show', ['ticket' => $this->_ticket_repository->showTicketId($ticket_id),
                    'services' => $this->_service_repository->getPaginate(100),
                    'users' => $this->_user_repository->getPaginate(100),
                    'scheduling' => $this->_scheduling_repository->showScheduling($ticket_manager_id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function inTreatment()
    {
        $user_auth = Auth::user();

        return view('ticket.intreatment', ['intreatment' =>$this->_ticket_repository->getTicketInProcessing($user_auth->user_id)]);
    }

    public function ticketNotResolved()
    {
        $user_auth = Auth::user();

        return view('ticket.notresolved', ['not_resolved' => $this->_ticket_repository->getTicketNotResolved($user_auth->user_id)]);
    }

    public function ticketResolved()
    {
        $user_auth = Auth::user();

        return view('ticket.resolved', ['resolved' => $this->_ticket_repository->getTicketResolved($user_auth->user_id),
                        'users_resolved' => $this->_user_repository->getPaginate(100)]);
    }

    public function ticketInAppointment()
    {
        $user_auth = Auth::user();

        return view('ticket.inappointment', ['in_appointment' => $this->_ticket_repository->getTicketInAppointment($user_auth->user_id),
                        'users' => $this->_user_repository]);
    }


    public function openTicket(OpenTicketRequest $request)
    {
        $this->_ticket_repository->openTicket(Auth::user()->user_id, $request->ticket_id);
        $this->_ticket_manager_repository->asignTicketToUser(Auth::user()->user_id, $request->ticket_id);

        return view('ticket.show', ['ticket' => $this->_ticket_repository->getTicketId($request->ticket_id),
        'services' => $this->_service_repository->getPaginate(100),
        'users' => $this->_user_repository->getPaginate(100)]);
    }

    public function validateResult(ValidateResultRequest $request)
    {
        $this->_ticket_manager_repository->resolvingTicket($request->all());

        $this->_ticket_repository->validatingResult($request->all());

        return view('ticket.show',  ['ticket' => $this->_ticket_repository->getTicketId($request->ticket_id),
                        'services' => $this->_service_repository->getPaginate(100),
                        'users' => $this->_user_repository->getPaginate(100)]);
        
    }
 
}
