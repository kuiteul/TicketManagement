<?php

namespace App\Repository;

use App\Models\ServiceModel;

class ServiceRepository
{
    protected $_services;

    public function __construct(ServiceModel $service)
    {
        $this->_services = $service;
    }

    public function save(ServiceModel $service, Array $input):void
    {
        $service->service_name = $input['service_name'];
        $service->service_location = $input['service_location'];
        $service->telephone = $input['telephone'];
        $service->department_id = $input['department_id'];
        $service->email_service = $input['email_service'];
        $service->save();
    }

    public function store(Array $input): void
    {
        $service = new $this->_services;

        $this->save($service, $input);
    }

    public function getPaginate($n)
    {
        return $this->_services->paginate($n);
    }

    public function getId(String $id)
    {
        return $this->_services->where('service_id', $id)->get();
    }

    public function update(Array $input, string $id)
    {
        return $this->_services->where('service_id', $id)->update($input);
    }

    public function delete(string $id)
    {
        return $this->_services->where('service_id', $id)->delete();
    }

    public function countService()
    {
        return $this->_services->count();
    }

}