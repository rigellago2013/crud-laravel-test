<?php

namespace App\Http\Controllers;

use App\Http\Services\ContactsService;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use DataTables;

class HomeController extends Controller
{
    private $contacts;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ContactsService $contacts)
    {
        $this->middleware('auth');
        $this->contacts = $contacts;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $contacts = $this->contacts->getAll();
            if($contacts) {
                return Datatables::of($contacts)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = ' <a href="javascript:void(0)" class="edit btn btn-success btn-sm btn-view d-inline" id="'.$row['id'].'">View</a>';
                    $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-danger btn-sm btn-delete d-inline"  id="'.$row['id'].'">Delete</a>';
     
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        }   
        return view('home');
    }
}
