<?php
namespace App\Http\Services;

use Illuminate\Http\Request;
use App\User;

class UserService extends BaseService
{
    public function __construct(Request $request, User $currentUser)
    {
        parent::__construct($currentUser, $request, $currentUser);
    }

    public function getAll(){
        return $this->model->all();    
    }


}