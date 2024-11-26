<?php

namespace App\Containers\AppSection\Document\Tasks;

use App\Containers\AppSection\Document\Data\Repositories\DocumentRepository;
use App\Containers\AppSection\Document\Enum\DocumentEnum;
use App\Containers\AppSection\Document\Models\Document;
use App\Containers\AppSection\Product\Models\Product;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Carbon\Carbon;
use Illuminate\Validation\Rules\Enum;

class CreateDocumentTask extends ParentTask
{
    public function __construct(
        protected readonly DocumentRepository $repository,
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data): Document
    {
        $documentItems = [];

        $dateInfo = Carbon::createFromFormat('Y-m-d H:i:s', $data['datetime_create']);

        foreach ($data['product_id'] as $key => $productId) {
            try {
                $product = Product::findOrFail($productId);
            } catch (\Exception $e) {
                throw new CreateResourceFailedException('Продукт не найден');
            }

            $currentQuantity = [];

            $pivotTable = $product->documents;
            foreach ($pivotTable as $pivotQuantity) {
                if ($pivotQuantity->type == DocumentEnum::COMING->value and $pivotQuantity->pivot->product_id == $productId) {
                     $currentQuantity[] = $pivotQuantity->pivot->quantity;
                } elseif ($pivotQuantity->type == DocumentEnum::CONSUMPTION->value and $pivotQuantity->pivot->product_id == $productId) {
                     $currentQuantity[] = -$pivotQuantity->pivot->quantity;
               }
            }

            switch ($data['type']) {
                case DocumentEnum::COMING->value:
                case DocumentEnum::CONSUMPTION->value:
                    $quantity = $data['quantity'][$key];
                    $documentItems[] = [
                        'product_id' => $productId,
                        'quantity' => $quantity,
                    ];
                    break;

                case DocumentEnum::INVENTORY->value:
                    $latestInventory = $this->repository->findWhere(['type' => DocumentEnum::INVENTORY->value])
                        ->sortByDesc('id')
                        ->first();

                    if ($latestInventory) {
                        $comingDocuments = $this->repository->findWhere([
                            ['type', '=', DocumentEnum::COMING->value],
                            ['id', '>=', $latestInventory['id']]
                        ]);

                        $consumptionDocuments = $this->repository->findWhere([
                            ['type', '=', DocumentEnum::CONSUMPTION->value],
                            ['id', '>=', $latestInventory['id']]
                        ]);

                    } else {
                        $comingDocuments = $this->repository->findWhere([
                            ['type', '=', DocumentEnum::COMING->value]
                        ]);

                        $consumptionDocuments = $this->repository->findWhere([
                            ['type', '=', DocumentEnum::CONSUMPTION->value]
                        ]);
                    }

                    $totalComing = [];
                    $totalConsumption = [];

                    foreach ($comingDocuments as $comingDocument) {
                        foreach ($comingDocument->products as $product_pivot) {
                            if ($product_pivot->id !== $productId) {
                                continue;
                            } else{
                                $quantity_pivot = $product_pivot->pivot->quantity;
                                $totalComing[] = $quantity_pivot;
                            }
                        }
                    }

                    foreach ($consumptionDocuments as $consumptionDocument) {
                        foreach ($consumptionDocument->products as $product_pivot) {
                            if ($product_pivot->id !== $productId) {
                                continue;
                            } else{
                                $quantity_pivot = $product_pivot->pivot->quantity;
                                $totalConsumption[] = $quantity_pivot;
                            }
                        }
                    }

                    $inventory = array_sum($totalComing) - array_sum($totalConsumption);
                    $inventoryError = $inventory - array_sum($currentQuantity);

                    $documentItems[] = [
                        'product_id' => $productId,
                        'quantity' => array_sum($currentQuantity),
                        'inventory_quantity' => $inventory,
                        'inventory_error' => $inventoryError,
                    ];

                    break;

            }
        }

        // Создание документа с товарами
        $document = $this->repository->create([
            'type' => $data['type'],
            'datetime_create' => $dateInfo
        ]);


        $syncData = [];
        foreach ($documentItems as $item) {
            $syncData[$item['product_id']] = [
                'quantity' => $item['quantity'],
                'inventory_quantity' => $item['inventory_quantity'] ?? null,
                'inventory_error' => $item['inventory_error'] ?? null,
            ];
        }

        $document->products()->attach($syncData);
        return $document;
    }
}
