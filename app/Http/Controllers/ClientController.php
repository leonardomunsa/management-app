<?php

namespace App\Http\Controllers;

use App\DTO\ClientDTO;
use App\Models\Client;
use App\Services\ClientService;
use Exception;
use Illuminate\Contracts\View\View as View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function __construct(protected ClientService $clientService)
    {
    }

    public function index(): View
    {
        $clients = Client::all();
        return view('clients/index', ['clients' => $clients]);
    }

    public function create(): View
    {
        return view('clients.create');
    }

    /**
     * @throws Exception
     */
    public function store(Request $request): RedirectResponse
    {
        $clientDTO = ClientDTO::fromRequest($request);

        $this->clientService->storeClient($clientDTO);

        return redirect()->route('clients.index');
    }

    public function show(Client $client)
    {
        return view('clients.show', ['client' => $client]);
    }

    public function edit(Client $client)
    {
        return Inertia::render('Clients/Edit', [
            'client' => $client,
        ]);
    }

    public function update(Request $request, Client $client): RedirectResponse
    {
        $client->update($request->all());
        return redirect()->route('clients.index');
    }

    public function destroy(Client $client): RedirectResponse
    {
        $client->delete();
        return redirect()->route('clients.index');
    }
}
