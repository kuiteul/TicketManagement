<?php

namespace App\Repository;

use App\Models\TicketManagerModel;
use DB;

class TicketManagerRepository
{

    protected $_ticket_manager;

    public function __construct(TicketManagerModel $ticket_manager)
    {
        $this->_ticket_manager = $ticket_manager;
    }

    public function save(TicketManagerModel $request, Array $input)
    {
        $request->service_id = $input['service_id'];
        $request->ticket_id = $input['ticket_id'];
        $request->save();
    }

    public function store(Array $input)
    {
        
        $ticket_manager = new $this->_ticket_manager;

        $this->save($ticket_manager, $input);
    }

    public function getTicketManagerId(string $ticket_id)
    {
        //return DB::table('ticketmanager')->select('ticket_manager_id')->where('ticket_id', $ticket_id)->get();
        return $this->_ticket_manager->select('ticket_manager_id')->where('ticket_id', $ticket_id)->get();
    }
    /**
     * count tickets belonging to a service
     */

     public function serviceTicket(string $service_id)
     {
        return $this->_ticket_manager->where('service_id', $service_id)->count();
     }
     /**
      * List tickets belonging to a service
      */
    public function getServiceTicket(string $service_id)
    {
        return $this->_ticket_manager->join('ticket', 'ticket.ticket_id', 'ticketmanager.ticket_id')
                                     ->join('users', 'users.user_id', 'ticket.user_id')
                                     ->where('ticketmanager.service_id', $service_id)
                                     ->orderBy('ticket.created_at', 'desc')
                                     ->get();
    }
     /**
      * count tickets asigned to a user
      */
    
    public function ticketAsignToUser(string $user_id)
    {
        return $this->_ticket_manager->join('ticket', 'ticket.ticket_id', 'ticketmanager.ticket_id')
                                     ->where('ticketmanager.user_id', $user_id)
                                     ->where('resolution', 'In processing')
                                     ->count();
    }
    /**
     * List tickets assign to a user
     */
    public function getTicketAsignToUser(string $user_id)
    {
        return $this->_ticket_manager->join('ticket', 'ticket.ticket_id', 'ticketmanager.ticket_id')
                                     ->join('users', 'users.user_id', 'ticketmanager.user_id')
                                     ->where('ticket.ticket_status', '<>', 'Closed') //We don't display closed tickets because its already resolved
                                     ->where('ticketmanager.user_id', $user_id)
                                     ->get();
    }

    public function asignTicketToUser(string $user_id, string $ticket_id)
    {
        $this->_ticket_manager->where('ticket_id', $ticket_id)->update([
                                                                'opened_at' => now(),
                                                                'user_id' => $user_id,
                                                                'asigned_by' => $user_id
                                                            ]);
        //$this->_ticket_manager->setTicketManager($user_id, $ticket_id);
    }

    public function asignTicketToMe(Array $input)
    {
        $this->_ticket_manager->where('ticket_id', $input['ticket_id'])->update([
                                                'user_id' => $input['user_id'],
                                                'asigned_by' => $input['user_id']
                                                ]);
    }
    
    public function resolvingTicket(Array $input)
    {
        if(isset($input['result']) && $input['result'] == 'resolved_with_confirm')
        {
            return $this->_ticket_manager->where('ticket_id', $input['ticket_id'])->update([
                'closed_at' => now(),
            ]);
        }
        
        if(isset($input['opened']))
        {
            return $this->asignTicketToUser($input['user_id'], $input['ticket_id']);
        }
        
    }


}