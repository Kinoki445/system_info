<?php

namespace App\Containers\AppSection\Product\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Product\Actions\UpdateProductAction;
use App\Containers\AppSection\Product\UI\API\Requests\UpdateProductRequest;
use App\Containers\AppSection\Product\UI\API\Transformers\ProductTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;

class UpdateProductController extends ApiController
{
    public function __construct(
        private readonly UpdateProductAction $action
    ) {
    }

    /**
     * @throws InvalidTransformerException
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function __invoke(UpdateProductRequest $request): array
    {
        $product = $this->action->run($request);

        return $this->transform($product, ProductTransformer::class);
    }
}
