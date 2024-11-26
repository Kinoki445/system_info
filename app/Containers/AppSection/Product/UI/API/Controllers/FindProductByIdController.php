<?php

namespace App\Containers\AppSection\Product\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Product\Actions\FindProductByIdAction;
use App\Containers\AppSection\Product\UI\API\Requests\FindProductByIdRequest;
use App\Containers\AppSection\Product\UI\API\Transformers\ProductTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class FindProductByIdController extends ApiController
{
    public function __construct(
        private readonly FindProductByIdAction $action
    ) {
    }

    /**
     * @throws InvalidTransformerException|NotFoundException
     */
    public function __invoke(FindProductByIdRequest $request): array
    {
        $product = $this->action->run($request);

        return $this->transform($product, ProductTransformer::class);
    }
}
