<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Facades\DB;

class DepartmentModel extends Model
{
    use HasUuids;
    use HasFactory;

    protected $table = "department";
    protected $primaryKey = 'department_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function updateDepartment(Array $request, $id)
    {
        return DB::table('department')->where('department_id', $id)
                                    ->update([
                                        'department_name' => $request['department_name'],
                                        'updated_at' => now()
                                    ]);
    }

  
    use HasFactory;
}
