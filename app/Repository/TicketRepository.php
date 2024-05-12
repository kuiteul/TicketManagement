<?php 

namespace App\Repository;

use App\Models\TicketModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TicketRepository
{

    protected $_ticket;

    public function __construct(TicketModel $ticket)
    {
        $this->_ticket = $ticket;
    }

    public function save(TicketModel $request, Array $input)
    {
        $track_id = str::random(20);
        $request->ticket_name = $input['ticket_label'];
        $request->comments = $input['comments'];
        $request->user_id = $input['user_id'];
        $request->track_id = $track_id;
        $request->save();
        return $track_id;
    }

    public function store(Array $input)
    {
        $ticket = new $this->_ticket;

        return $this->save($ticket, $input);
    }

    public function getPaginate($n)
    {
        return $this->_ticket->orderBy('created_at')->get();
    }

    public function getTicketId(string $id)
    {
        return $this->_ticket->join('users', 'users.user_id', 'ticket.user_id')
                             ->join('ticketmanager', 'ticketmanager.ticket_id', 'ticket.ticket_id')
                             ->where('ticket.ticket_id', $id)
                             ->get();   
    }

    /**
     * Show ticket ID
     */
    public function showTicketId(string $id)
    {
        return $this->_ticket->join('ticketmanager', 'ticketmanager.ticket_id', 'ticket.ticket_id')
                             ->where('ticket.ticket_id', $id)
                             ->get();
    }

    /**
     * Select a ticket according to his track_id record.
     * This will help us to get the ticket_id and store it in ticketmanager table. 
     */
    public function getTicketByTrackId(string $id)
    {
       return  $ticket_id = DB::table('ticket')->select('ticket_id')->where('track_id', $id)->get();
    
    }

    
    /**
     * Retrieve all tickets belonging to a specific user.
     * These tickets are that has been created by the users.
     */
    public function ticketBelongToUser(string $user_id)
    {
        return $this->_ticket->join('ticketmanager', 'ticket.ticket_id', 'ticketmanager.ticket_id')
                             ->join('services', 'ticketmanager.service_id', 'services.service_id')
                             ->where('ticket.user_id', $user_id)
                             ->get();
    }

    /**
     * Count all tickets present in the table
     */
    public function countTicket()
    {
        return $this->_ticket->count();
    }

    /**
     * Count ticket created by user and not resolved
     */
    public function ticketNotResolved(string $user_id)
    {
        return $this->_ticket->where('ticket_status', 'Not Opened')    
                             ->where('user_id', $user_id)                         
                             ->count();
    }
    /**
     * list of tickets created by user but not resolved
     */
    public function getTicketNotResolved(string $user_id)
    {
        return $this->_ticket->join('ticketmanager', 'ticketmanager.ticket_id', 'ticket.ticket_id')
                             ->join('services', 'services.service_id', 'ticketmanager.service_id')
                             ->where('ticket.resolution', 'Not resolved')
                             ->where('ticket.user_id', $user_id) // We retrieve the user id who created the ticket
                             ->get();
    }
    /**
     * Count of ticket created by user and Resolved
     */
    public function ticketResolved(string $user_id)
    {
        return $this->_ticket->where('resolution', 'Resolved')
                             ->where('user_id', $user_id) // We retrieve the user id who has resolved the problem
                             ->count();
    }
    /**
     * List ticket created by user and resolved
     */
    public function getTicketResolved(string $user_id)
    {
        return $this->_ticket->join('ticketmanager', 'ticketmanager.ticket_id', 'ticket.ticket_id')
                             ->join('users', 'users.user_id', 'ticketmanager.user_id')
                             ->where('ticket.resolution', 'Resolved')
                             ->where('ticket.user_id', $user_id)
                             ->get();
    }
    /**
     * Count ticket created by user and in appointment
     */
    public function ticketInAppointment(string $user_id)
    {
        return $this->_ticket->where('resolution', 'Appointment')
                             ->where('user_id', $user_id)
                             ->count();
    }
    /**
     * List ticket created by user and in appointment
     */
    public function getTicketInAppointment(string $user_id)
    {
        return $this->_ticket->join('ticketmanager', 'ticketmanager.ticket_id', 'ticket.ticket_id')
                             ->join('scheduling', 'scheduling.ticketmanager_id_fk', 'ticket_manager_id')
                             ->where('ticket.resolution', 'Appointment')
                             ->where('ticket.user_id', $user_id)
                             ->get();
    }
    /**
     * Count ticket created by user and in processiong
     */
    public function ticketInProcessing(string $user_id)
    {
        return $this->_ticket->where('resolution', 'In processing')
                             ->where('user_id', $user_id)
                             ->count();
    }
    /**
     * List ticket created by user and in processing
     */
    public function getTicketInProcessing(string $user_id)
    {
        return $this->_ticket->join('ticketmanager', 'ticketmanager.ticket_id', 'ticket.ticket_id')
                             ->where('ticket.resolution', 'In processing')
                             ->where('ticket.user_id', $user_id)
                             ->get();
    }

    /**
     * Open ticket
     */

     public function openTicket(string $user_id, string $ticket_id)
     {
        return $this->_ticket->where('ticket_id', $ticket_id)->update([
                                                    'ticket_status' => 'Opened',
                                                    'resolution' => 'In processing'
                                                ]);
        // return $this->_ticket->setTicketOpen($user_id, $ticket_id);
     }

     /**
      * return ticket id according to user that created
      */

    public function getUserTicketId(string $user_id)
    {
        return $this->_ticket->select('ticket_id')->where('user_id', $user_id)->get();
    }

     /**
     * Validating result 
     */
    public function validatingResult(Array $input)
    {   
       if(isset($input['result']) && $input['result'] == 'resolved_with_confirm')
       {
            return $this->_ticket->where('ticket_id', $input['ticket_id'])->update([
                'ticket_status' => 'Closed',
                'resolution' => 'Resolved',
                'updated_at' => now()
            ]);
       }

    }

    public function scheduleTicket(string $id)
    {
        return $this->_ticket->where('ticket_id', $id)->update([
            'resolution' => 'Appointment',
            'updated_at' => now()
        ]);
    }
}