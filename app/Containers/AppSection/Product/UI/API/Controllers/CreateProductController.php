<?php

namespace App\Containers\AppSection\Product\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Product\Actions\CreateProductAction;
use App\Containers\AppSection\Product\UI\API\Requests\CreateProductRequest;
use App\Containers\AppSection\Product\UI\API\Transformers\ProductTransformer;
use App\Containers\AppSection\Product\Value\ProductValue;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class CreateProductController extends ApiController
{
    public function __construct(
        private readonly CreateProductAction $action,
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     * @throws InvalidTransformerException
     * @throws IncorrectIdException
     */
    public function __invoke(CreateProductRequest $request): JsonResponse
    {
        $value = new ProductValue();
        $value->setName($request->name);
        $value->setPrice($request->price);
        $value->setQuantity($request->quantity);

        $product = $this->action->run($value);
        return $this->created($this->transform($product, ProductTransformer::class));
    }
}
