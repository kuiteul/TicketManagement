<?php

namespace App\Repository;

use App\Models\FeedbackModel;

class FeedbackRepository
{
    protected $_feedback;

    public function __construct(FeedbackModel $feedback)
    {
        $this->_feedback = $feedback;
    }

    public function save(FeedbackModel $feedback, Array $input)
    {
        $feedback->notes = $input['notes'];
        $feedback->comments = $input['comments'];
        $feedback->user_id = $input['user_id'];
        $feedback->ticket_id = $input['ticket_id'];
        $feedback->ticket_manager_id_fk = $input['ticket_manager_id_fk'];
        $feedback->save();
    }

    public function store(Array $array)
    {
        $feedback = new $this->_feedback;

        $this->save($feedback, $array);
    }

    public function getPaginate(int $number)
    {
        return $this->_feedback->paginate($number);
    }

    public function show(string $feedback_id)
    {
        return $this->_feedback->where('feedback_id', $feedback_id);
        //SELECT * FROM feedback WHERE feedback_id = ?
        //array['feedback_id' => $feedback]
    }

}