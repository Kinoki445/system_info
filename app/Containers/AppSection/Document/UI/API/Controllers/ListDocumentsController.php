<?php

namespace App\Containers\AppSection\Document\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Document\Actions\ListDocumentsAction;
use App\Containers\AppSection\Document\UI\API\Requests\ListDocumentsRequest;
use App\Containers\AppSection\Document\UI\API\Transformers\DocumentTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Prettus\Repository\Exceptions\RepositoryException;

class ListDocumentsController extends ApiController
{
    public function __construct(
        private readonly ListDocumentsAction $action
    ) {
    }

    /**
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function __invoke(ListDocumentsRequest $request): array
    {
        $documents = $this->action->run($request);

        return $this->transform($documents, DocumentTransformer::class);
    }
}
