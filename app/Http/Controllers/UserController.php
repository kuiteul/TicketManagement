<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Repository\UserRepository;
use App\Repository\ServiceRepository;

class UserController extends Controller
{
    protected $_user_repository;
    protected $_service_repository;

    public function __construct(UserRepository $user_repository, ServiceRepository $service_repository)
    {
        $this->_user_repository = $user_repository;
        $this->_service_repository = $service_repository;
    }
    /**
     * Display a listing of the resource.
     * 
     */
    public function index()
    {
        return view('user.index', ['user' => $this->_user_repository->getPaginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('user.create', ['service' => $this->_service_repository->getPaginate(20)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $result = $this->_user_repository->store($request->all());
        
        return view('user.index', ['user' => $this->_user_repository->getPaginate(20), 'result' => $result ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        return view('user.show', ['user' => $this->_user_repository->getId($id), 
                                    'user_service' => $this->_user_repository->getUserAndService($id),
                                        'service' => $this->_service_repository->getPaginate(20)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('user.edit', ['user' => $this->_user_repository->getId($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->_user_repository->update($request->except('_token','_method'), $id);

        return view('user.show', ['user' => $this->_user_repository->getId($id), 
        'service' => $this->_user_repository->getUserAndService($id)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->_user_repository->delete($id);
        return $this->index();
    }
}
