<?php

namespace App\Containers\AppSection\Product\Tasks;

use App\Containers\AppSection\Document\Enum\DocumentEnum;
use App\Containers\AppSection\Document\Models\Document;
use App\Containers\AppSection\Product\Data\Repositories\ProductRepository;
use App\Containers\AppSection\Product\Models\Product;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Carbon\Carbon;

class CreateProductTask extends ParentTask
{
    public function __construct(
        protected readonly ProductRepository $repository,
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data): Product
    {
        $product = $this->repository->create([
            'name' => $data['name'],
            'price' => $data['price'],
        ]);

        $document = Document::create([
            'type' => DocumentEnum::COMING->value,
            'datetime_create' => Carbon::now(),
        ]);

        $document->products()->attach($product->id, [
            'quantity' => $data['quantity']
        ]);

        return $product;
    }
}
