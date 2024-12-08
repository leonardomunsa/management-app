<?php

namespace App\DTO;

use App\Rules\CNPJ;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ClientDTO
{
    public string $name;
    public string $cnpj;
    public ?string $address;
    public ?string $number;

    public function __construct(string $name, string $cnpj, ?string $address, ?string $number)
    {
        $this->name = $name;
        $this->cnpj = $cnpj;
        $this->address = $address;
        $this->number = $number;
    }

    /**
     * @param Request $request
     * @return ClientDTO
     * @throws ValidationException
     */
    public static function fromRequest(Request $request): ClientDTO
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cnpj' => ['required', 'string', new CNPJ()],
            'address' => 'nullable|string',
            'number' => 'nullable|string|max:15',
        ]);

        return new self(
            $validated['name'],
            $validated['cnpj'],
            $validated['address'] ?? null,
            $validated['number'] ?? null
        );
    }

    public static function fromUpdateRequest(Request $request): array
    {
        return $request->validate([
            'name' => 'string|max:255',
            'cnpj' => ['string', new CNPJ()],
            'address' => 'nullable|string',
            'number' => 'nullable|string|max:15',
        ]);
    }
}
