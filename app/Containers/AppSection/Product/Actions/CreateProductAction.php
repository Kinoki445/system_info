<?php

namespace App\Containers\AppSection\Product\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Product\Models\Product;
use App\Containers\AppSection\Product\Tasks\CreateProductTask;
use App\Containers\AppSection\Product\UI\API\Requests\CreateProductRequest;
use App\Containers\AppSection\Product\Value\ProductValue;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateProductAction extends ParentAction
{
    public function __construct(
        private readonly CreateProductTask $createProductTask,
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(ProductValue $data): Product
    {
        $data=[
            'name' => $data->getName(),
            'quantity' => $data->getQuantity(),
            'price' => $data->getPrice(),
        ];

        return $this->createProductTask->run($data);
    }
}
