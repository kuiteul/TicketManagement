<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use App\Repository\DepartmentRepository;

class DepartmentController extends Controller
{
    protected $_department_repository;

    public function __construct(DepartmentRepository $repository)
    {
        $this->_department_repository = $repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('department.index', ['department' => $this->_department_repository->getPaginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        $this->_department_repository->store($request->all());

        return view('department.index', ['result' => "success", 'department' => $this->_department_repository->getPaginate(20)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('department.edit', ['department' => $this->_department_repository->getById($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, string $id)
    {
        $this->_department_repository->update($request->all(), $id);

        return view('department.index', ['department' => $this->_department_repository->getPaginate(20)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->_department_repository->destroy($id);
        return view('department.index', ['department' => $this->_department_repository->getPaginate(20)]);
    }
}
