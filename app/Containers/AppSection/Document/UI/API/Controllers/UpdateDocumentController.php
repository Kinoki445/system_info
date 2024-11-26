<?php

namespace App\Containers\AppSection\Document\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Document\Actions\UpdateDocumentAction;
use App\Containers\AppSection\Document\UI\API\Requests\UpdateDocumentRequest;
use App\Containers\AppSection\Document\UI\API\Transformers\DocumentTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;

class UpdateDocumentController extends ApiController
{
    public function __construct(
        private readonly UpdateDocumentAction $action
    ) {
    }

    /**
     * @throws InvalidTransformerException
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function __invoke(UpdateDocumentRequest $request): array
    {
        $document = $this->action->run($request);

        return $this->transform($document, DocumentTransformer::class);
    }
}
