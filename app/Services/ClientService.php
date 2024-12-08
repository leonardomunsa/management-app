<?php

namespace App\Services;

use App\DTO\ClientDTO;
use App\Models\Client;
use Exception;

class ClientService
{
    /**
     * @throws Exception
     */
    public function storeClient(ClientDTO $clientData): void
    {
        $client = Client::findByCnpj($clientData->cnpj);
        if (!empty($client)) {
            throw new Exception('Client already exists', 400);
        }

        $newClient = new Client([
            'name' => $clientData->name,
            'cnpj' => $clientData->cnpj,
            'address' => $clientData->address,
            'number' => $clientData->number
        ]);
        $newClient->save();
    }

    public function getClient()
    {

    }
}
