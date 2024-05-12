<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FeedbackRequest;
use App\Repository\FeedbackRepository;
use App\Repository\TicketRepository;
use App\Repository\TicketManagerRepository;
use Auth;

class FeedbackController extends Controller
{

    protected $_feedback_repository;
    protected $_ticket_repository;
    protected $_ticketmanager_repository;

    public function __construct(FeedbackRepository $feedback, TicketRepository $ticket, TicketManagerRepository $ticketmanager)
    {
        $this->_feedback_repository = $feedback;
        $this->_ticket_repository = $ticket;
        $this->_ticketmanager_repository = $ticketmanager;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('feedback.index', ['feedback' => $this->_feedback_repository->getPaginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_id = Auth::user()->user_id;
        $ticket_id = $this->_ticket_repository->getUserTicketId($user_id);
        $ticket_manager_id = $this->_ticketmanager_repository->getUserId();
        return view('feedback.create', ['user_id' => $user_id, 'ticket_id' => $ticket_id, 'ticket_manager_id' => $ticket_manager_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeedbackRequest $request)
    {
        return view('feedback.index', ['feedback' => $this->_feedback_repository->store($request->all())]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $feedback_id)
    {
        return view('feedback.show', ['feedback' => $this->_feedback_repository->show($id)]);
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
}
