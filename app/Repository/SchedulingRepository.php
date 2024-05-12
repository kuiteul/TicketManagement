<?php

namespace App\Repository;

use App\Models\SchedulingModel;

class SchedulingRepository
{
    protected $_scheduling;

    public function __construct(SchedulingModel $scheduling)
    {
        $this->_scheduling = $scheduling;
    }

    public function save(SchedulingModel $scheduling, Array $input)
    {
        $scheduling->date_started = $input['date_started'];
        $scheduling->date_ended = $input['date_ended'];
        $scheduling->scheduled_reason = $input['scheduling_reason'];
        $scheduling->ticketmanager_id_fk = $input['ticket_manager_id'];
        $scheduling->save();
    }

    public function store(Array $input)
    {
        $scheduling = new $this->_scheduling;

        $this->save($scheduling, $input);
    }

    public function getPaginate(int $number)
    {
        return $this->_scheduling->paginate($number);
    }

    public function getId(string $scheduling_id)
    {
        return $this->_scheduling->where('scheduling_id', $scheduling_id)->get();
    }

    public function showScheduling(string $ticket_manager_id)
    {
        
        return $this->_scheduling->where('ticketmanager_id_fk', $ticket_manager_id)
                                 ->get();
    }
    
    public function update(string $scheduling_id, Array $input)
    {
        return $this->_scheduling->where('scheduling_id', $scheduling_id)->update([
            'date_started' => $input['date_started'],
            'date_ended' => $input['date_ended'],
            'scheduling_reason' => $input['scheduling_reason']
        ]);
    }

    public function delete(string $id)
    {
        return $this->_scheduling->where('scheduling_id', $scheduling_id)->delete();
    }


}