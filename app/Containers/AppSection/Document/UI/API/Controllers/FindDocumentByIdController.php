<?php

namespace App\Containers\AppSection\Document\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Document\Actions\FindDocumentByIdAction;
use App\Containers\AppSection\Document\UI\API\Requests\FindDocumentByIdRequest;
use App\Containers\AppSection\Document\UI\API\Transformers\DocumentTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class FindDocumentByIdController extends ApiController
{
    public function __construct(
        private readonly FindDocumentByIdAction $action
    ) {
    }

    /**
     * @throws InvalidTransformerException|NotFoundException
     */
    public function __invoke(FindDocumentByIdRequest $request): array
    {
        $document = $this->action->run($request);

        return $this->transform($document, DocumentTransformer::class);
    }
}
