<?php

namespace App\Containers\AppSection\Product\Data\Factories;

use App\Containers\AppSection\Product\Models\Product;
use App\Ship\Parents\Factories\Factory as ParentFactory;

/**
 * @template TModel of ProductFactory
 *
 * @extends ParentFactory<TModel>
 */
class ProductFactory extends ParentFactory
{
    /** @var class-string<TModel> */
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            //
        ];
    }
}
