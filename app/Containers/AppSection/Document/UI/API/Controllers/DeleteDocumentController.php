<?php

namespace App\Containers\AppSection\Document\UI\API\Controllers;

use App\Containers\AppSection\Document\Actions\DeleteDocumentAction;
use App\Containers\AppSection\Document\UI\API\Requests\DeleteDocumentRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class DeleteDocumentController extends ApiController
{
    public function __construct(
        private readonly DeleteDocumentAction $action,
    ) {
    }

    /**
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function __invoke(DeleteDocumentRequest $request): JsonResponse
    {
        $this->action->run($request);

        return $this->noContent();
    }
}
