<?php

namespace App\DTO;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OrderDTO
{
    public function __construct(
        public int $number,
        public string $date,
        public ?bool $finished,
        public float $amount,
        public array $sales,
        public ?int $user_id = null
    ) {}

    /**
     * @param Request $request
     * @return OrderDTO
     * @throws ValidationException
     */
    public static function fromRequest(Request $request): OrderDTO
    {
        $validated = $request->validate([
            'number'   => 'required|numeric',
            'date'     => 'required|string',
            'finished' => 'nullable|boolean',
            'amount'   => 'required|numeric',
            'sales'    => 'required|array',
        ]);

        return new self(
            $validated['number'],
            $validated['date'],
            $validated['finished'] ?? null,
            $validated['amount'],
            $validated['sales']
        );
    }

    public static function fromUpdateRequest(Request $request): array
    {
        return $request->validate([
            'number'   => 'numeric',
            'date'     => 'string',
            'finished' => 'nullable|boolean',
            'amount'   => 'numeric',
            'sales'    => 'array',
        ]);
    }
}
