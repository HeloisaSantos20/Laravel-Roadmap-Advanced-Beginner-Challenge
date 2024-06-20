<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $clientRequest = request()->input('client');

        /** @var Client $clients */
        $clients = Client::when($clientRequest, function ($query) use ($clientRequest) {
            $query->where('company',  'like', "%$clientRequest%");
        })->latest()->paginate(10);

        return view('clients.index', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client = $request->all();

        Client::create($client);
        session()->flash('messageSuccess','Client successfully created!');

        return redirect()->route('clients.create');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);

        return view('clients.client', ['client' => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);

        return view('clients.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->update($request->all());

        session()->flash('messageSuccess','Client successfully updated!');

        return redirect()->route('clients.show', [$client->id] );

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);

        $client->delete();

        session()->flash('messageSuccess','Client successfully deleted!');

        return redirect(route('clients.index'));
    }
}
