<?php

namespace App\Services;

use App\DTO\SaleDTO;
use App\Models\Sale;
use Illuminate\Support\Collection;

class SaleService
{
    public function storeSale(SaleDTO $saleData): void
    {
        $newSale = new Sale([
            'details' => $saleData->details,
            'amount' => $saleData->amount,
            'paid' => $saleData->paid ?? false,
            'client_uuid' => $saleData->clientUuid
        ]);
        $newSale->save();
    }

    public function getSalesWithoutOrder(): Collection
    {
        return Sale::query()
            ->whereNull('order_number')
            ->get();
    }

    public function updateSales(array $sales, int $number): void
    {
        Sale::query()
            ->whereIn('uuid', $sales)
            ->update(['order_number' => $number]);
    }
}
