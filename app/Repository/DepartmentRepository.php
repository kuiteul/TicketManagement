<?php 

namespace App\Repository;

use App\Models\DepartmentModel;
use Illuminate\Support\Str;

class DepartmentRepository{

    protected $_department;

    public function __construct(DepartmentModel $department)
    {
        $this->_department = $department;
    }

    public function save(DepartmentModel $department, Array $request): void
    {
        $department->department_name = $request['department_name'];
        $department->save();
    }

    public function store(Array $input)
    {
        $department = new $this->_department;
        $this->save($department, $input);

        return $department;
    }

    public function getPaginate($n)
    {

        return $this->_department->paginate($n);

    }

    public function getById($id)
    {
        return $this->_department->where('department_id', $id)->get();
    }

    public function update(Array $input, $id)
    {

        return $this->_department->updateDepartment($input, $id);
    }

    public function destroy($id)
    {
        $this->_department->where('department_id', $id)->delete();

        return "Success";
    }

    public function countDepartment()
    {
        return $this->_department->count();
    }

}

