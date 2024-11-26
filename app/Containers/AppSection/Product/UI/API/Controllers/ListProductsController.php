<?php

namespace App\Containers\AppSection\Product\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Product\Actions\ListProductsAction;
use App\Containers\AppSection\Product\UI\API\Requests\ListProductsRequest;
use App\Containers\AppSection\Product\UI\API\Transformers\ProductTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Prettus\Repository\Exceptions\RepositoryException;

class ListProductsController extends ApiController
{
    public function __construct(
        private readonly ListProductsAction $action
    ) {
    }

    /**
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function __invoke(ListProductsRequest $request): array
    {
        $products = $this->action->run($request);

        return $this->transform($products, ProductTransformer::class);
    }
}
