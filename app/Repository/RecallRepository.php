<?php 

namespace App\Repository;

use App\Models\RecallModel;

class RecallRepository
{
    protected $_recall;

    public function __construct(RecallModel $recall)
    {
        $this->_recall = $recall;
    }

    public function save(RecallModel $recall, Array $input)
    {
        $recall->ticket_id = $input['ticket_id'];
        $recall->user_id = $input['user_id'];
        $recall->save();
    }

    public function store(Array $input)
    {
        $recall = new $this->_recall;

        $this->save($recall, $input);

        return "Yes";
    }

    public function getRecall(string $id)
    {
        return $this->_recall->where('relance_id', $id)->get();
    }

    public function getPaginate(int $number)
    {
        return $this->_recall->paginate($number);
    }

    public function getRecallByTicket(string $ticket_id)
    {
        return $this->_recall->where('ticket_id', $ticket_id);
    }

    public function getRecallByUser(string $user_id)
    {
        return $this->_recall->where('user_id', $user_id);
    }

    public function checkRecall(string $ticket_id)
    {
        if($this->_recall->created_at - date('h:m:s') < "01:00:11")
            return true;
        else
            return false;
    }
}