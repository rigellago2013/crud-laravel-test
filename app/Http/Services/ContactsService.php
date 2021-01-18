<?php
namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Contacts;
use App\User;

class ContactsService extends BaseService
{
    public function __construct(Request $request, User $currentUser, Contacts $contacts)
    {
        parent::__construct($contacts, $request, $currentUser);
    }

    public function getAll(){
        return $this->model->all();    
    }


}