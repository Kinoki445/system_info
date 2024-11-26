<?php

namespace App\Containers\AppSection\Product\UI\API\Transformers;

use App\Containers\AppSection\Product\Models\Product;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class ProductTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform($product): array
    {
        return $response = [
            'id' => $product->getHashedKey(),
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $product->quantity,
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at,
        ];
    }
}
