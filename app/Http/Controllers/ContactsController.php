<?php

namespace App\Http\Controllers;

use App\Contacts;
use App\Http\Services\ContactsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactsController extends Controller
{
    private $contacts;

    public function __construct(ContactsService $contacts)
    {
        $this->middleware('auth');
        $this->contacts = $contacts;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = [
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'gender' => $request['gender'],
            'birthday' => $request['birthday'],
            'contact_number' => $request['contact_number'],
            'address' => $request['address'],
            'city' => $request['city'],
            'country' => $request['country'],
            'province' => $request['province'],
            'zip_code' => $request['zip_code'],
        ];

        $validator =  Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:contacts'],
            'gender' => ['required', 'string', 'max:10'],
            'birthday' => ['required', 'date'],
            'contact_number' => ['required', 'string', 'max:52'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'string', 'max:10'],
        
        ]);

        if ($validator->fails()) {
            return redirect('home')
                        ->withErrors($validator)
                        ->withInput();
        }

        $contact = Contacts::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'birthday' => $data['birthday'],
            'contact_number' => $data['contact_number'],
            'address' => $data['address'],
            'city' => $data['city'],
            'country' => $data['country'],
            'province' => $data['province'],
            'zip_code' => $data['zip_code'],
        ]);

        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = $this->contacts->find($id);

        return view('contacts.view', ['contact' => $contact]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $contact = $this->contacts->findOrFail($request->id);
  
        $data = [
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'gender' => $request['gender'],
            'birthday' => $request['birthday'],
            'contact_number' => $request['contact_number'],
            'address' => $request['address'],
            'city' => $request['city'],
            'country' => $request['country'],
            'province' => $request['province'],
            'zip_code' => $request['zip_code'],
        ];

        $validator =  Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:contacts'],
            'gender' => ['required', 'string', 'max:10'],
            'birthday' => ['required', 'date'],
            'contact_number' => ['required', 'string', 'max:52'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'string', 'max:10'],
        ]);

        $contact->fill($data)->save();
        return redirect('home')->with('success', 'Contact successfully updated.');   

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contacts $contacts)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = $this->contacts->find($id);
        $contact->delete();
        return redirect('home')->with('success', 'Contact successfully deleted.');   

    }

    /**
     * Create a new contact instance.
     *
     * @param  array  $data
     * @return \App\Contact
     */
    protected function create(array $data)
    {
        
    }
}
