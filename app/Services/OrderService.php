<?php

namespace App\Services;

use App\DTO\OrderDTO;
use App\Models\Order;
use App\Models\Sale;
use Exception;

class OrderService
{
    public function __construct(protected SaleService $saleService)
    {
    }

    /**
     * @throws Exception
     */
    public function storeOrder(OrderDTO $orderData): void
    {
        $newOrder = new Order([
            'number' => $orderData->number,
            'date' => new \DateTime($orderData->date),
            'amount' => $orderData->amount,
            'finished' => $orderData->finished ?? false
        ]);
        $newOrder->save();

        $this->saleService->updateSales($orderData->sales, $orderData->number);
    }

}
