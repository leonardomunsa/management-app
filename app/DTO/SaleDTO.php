<?php

namespace App\DTO;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SaleDTO
{
    public function __construct(
        public string $details,
        public float $amount,
        public ?bool $paid,
        public ?int $orderId,
        public string $clientUuid
    )
    {
    }

    /**
     * @param Request $request
     * @return SaleDTO
     * @throws ValidationException
     */
    public static function fromRequest(Request $request): SaleDTO
    {
        $validated = $request->validate([
            'details' => 'required|string|max:800',
            'amount' => 'required|numeric',
            'paid' => 'nullable|boolean',
            'orderId' => 'nullable|integer',
            'clientUuid' => 'required|string|max:255'
        ]);

        return new self(
            $validated['details'],
            $validated['amount'],
            $validated['paid'] ?? null,
            $validated['orderId'] ?? null,
            $validated['clientUuid']
        );
    }

    public static function fromUpdateRequest(Request $request): array
    {
        return $request->validate([
            'details' => 'string|max:800',
            'amount' => 'numeric',
            'paid' => 'boolean',
            'orderId' => 'integer',
            'clientUuid' => 'string|max:255'
        ]);
    }
}
