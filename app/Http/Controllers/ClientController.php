<?php

namespace App\Http\Controllers;

use App\DTO\ClientDTO;
use App\Models\Client;
use App\Services\ClientService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class ClientController extends Controller
{
    public function __construct(protected ClientService $clientService)
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $clients = Client::where('user_id', auth()->id())->get();
        return view('clients.index', compact('clients'));
    }

    public function create(): View
    {
        $this->authorize('create', Client::class);
        return view('clients.create');
    }

    /**
     * @throws Exception
     */
    public function store(Request $request): RedirectResponse
    {
        $clientDTO = ClientDTO::fromRequest($request);
        $clientDTO->user_id = auth()->id();

        $this->clientService->storeClient($clientDTO);
        return redirect()->route('clients.index');
    }

    public function show(Client $client): View
    {
        $this->authorize('view', $client);
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client): View
    {
        $this->authorize('update', $client);
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client): RedirectResponse
    {
        $this->authorize('update', $client);
        $clientUpdate = ClientDTO::fromUpdateRequest($request);
        $client->update($clientUpdate);
        return redirect()->route('clients.show', compact('client'));
    }

    public function destroy(Client $client): RedirectResponse
    {
        $this->authorize('delete', $client);
        $client->delete();
        return redirect()->route('clients.index');
    }
}
