<?php 

namespace App\Repository;

use App\Models\UserModel;
use Illuminate\Support\Str;


class UserRepository {

    protected $_user_repository;
    

    public function __construct(UserModel $user)
    {
        $this->_user_repository = $user;
    }

    public function save(UserModel $user, Array $input)
    {
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->email = $input['email'];
        $user->telephone = $input['telephone'];
        $user->service_id = $input['service_id'];
        $user->password = bcrypt($input['password']);
        $user->title = $input['position'];
        $user->role = $input['role'];
        $user->save();
    }

    public function checkUser(string $email)
    {
        $result = $this->_user_repository->where('email', $email)->count();
        
        return ($result > 0) ? true : false;
    }

    public function store(Array $input)
    {
        $user = new $this->_user_repository;

        return $this->checkUser($input['email']) ? false : $this->save($user, $input); // if the user existe we return false else we save him
    }

    public function getPaginate(int $n)
    {
        return $this->_user_repository->paginate($n);
    }

    public function getId(string $id)
    {
        return $this->_user_repository->where('user_id', $id)->get();
    }

    public function getUserAndService(string $user_id)
    {
        return $this->_user_repository->userAndService($user_id);
    }

    public function update(Array $request, string $id)
    {
        return $this->_user_repository->where('user_id', $id)->update($request);
    }

    public function delete(string $id)
    {
        return $this->_user_repository->where('user_id', $id)->delete();
    }

    public function countUser()
    {
        return $this->_user_repository->count();
    }
}