<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;
use App\Repository\ServiceRepository;
use App\Repository\DepartmentRepository;

class ServiceController extends Controller
{
    protected $_service_repository;
    protected $_department_repository;

    public function __construct(ServiceRepository $service, DepartmentRepository $department)
    {
        $this->_service_repository = $service;
        $this->_department_repository = $department;
    }

    public function index()
    {
        return view('service.index', ['service' => $this->_service_repository->getPaginate(20)]);
    }

    public function create()
    {
    
        return view('service.new_service', ['department' => $this->_department_repository->getPaginate(30)]);
    }

    public function store(ServiceRequest $request)
    {
        $this->_service_repository->store($request->all());
        return $this->index();
    }

    public function edit(string $id)
    {
        $department_id = [];
        foreach($this->_department_repository->getPaginate(20) as $item)
        {
            $department = array_push($department_id, $item->department_id );
        }
        return view('service.edit', ['service' => $this->_service_repository->getId($id), 'department' => $this->_department_repository->getPaginate(20),
                                    'department_id' => $department_id]);
    }

    public function update(ServiceRequest $request, $id)
    {
        $this->_service_repository->update($request->except('_token','_method'), $id);
        return view('service.index', ['service' => $this->_service_repository->getPaginate(20)]);
    }

    public function destroy(string $id)
    {
        $this->_service_repository->delete($id);
        return view('service.index', ['service' => $this->_service_repository->getPaginate(20)]);
    }
}
