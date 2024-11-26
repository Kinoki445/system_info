<?php

namespace App\Containers\AppSection\Document\Data\Factories;

use App\Containers\AppSection\Document\Models\Document;
use App\Ship\Parents\Factories\Factory as ParentFactory;

/**
 * @template TModel of DocumentFactory
 *
 * @extends ParentFactory<TModel>
 */
class DocumentFactory extends ParentFactory
{
    /** @var class-string<TModel> */
    protected $model = Document::class;

    public function definition(): array
    {
        return [
            //
        ];
    }
}
