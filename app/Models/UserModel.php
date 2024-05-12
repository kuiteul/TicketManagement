<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    protected $table = "users";
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';
    
    use HasUuids;
    
    use HasFactory;

    public function userAndService($user_id)
    {
        $data = DB::table('services')->join('users', 'users.service_id', '=', 'services.service_id')
                    ->where('users.user_id', $user_id)
                    ->get();
        return $data;
    }
}
