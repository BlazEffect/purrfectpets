<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $products = $this->data['products'];

        $price = 0;

        foreach ($products as $product) {
            $price += $product['price'] * $product['count'];
        }

        $data['price'] = $price;

        return $data;
    }
}
