<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repository\DepartmentRepository;
use App\Repository\ServiceRepository;
use App\Repository\UserRepository;
use App\Repository\TicketRepository;

class AdminController extends Controller
{
    protected $_department_repository;
    protected $_service_repository;
    protected $_user_repository;
    protected $_ticket_repository;

    public function __construct(DepartmentRepository $department, ServiceRepository $service, UserRepository $user,
                TicketRepository $ticket)
    {
        $this->_department_repository = $department;
        $this->_service_repository = $service;
        $this->_user_repository = $user;
        $this->_ticket_repository = $ticket;
    }
    public function index()
    {
        return view('administration.index', ['department_number' => $this->_department_repository->countDepartment(), 'service_number' => $this->_service_repository->countService(),
                'user_number' => $this->_user_repository->countUser(), 'ticket_number' => $this->_ticket_repository->countTicket()]);
    }
}
