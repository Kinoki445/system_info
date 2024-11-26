<?php

namespace App\Containers\AppSection\Document\UI\API\Transformers;

use App\Containers\AppSection\Document\Models\Document;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class DocumentTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Document $document): array
    {
       return [
            'object' => $document->getResourceKey(),
            'id' => $document->getHashedKey(),
            'type' => $document->type,
            'datetime_create' => $document->datetime_create,
            'product_id' => $document->product_id,
            'quantity' => $document->quantity,
            'price' => $document->price,
            'created_at' => $document->created_at,
            'updated_at' => $document->updated_at,
        ];
    }
}
