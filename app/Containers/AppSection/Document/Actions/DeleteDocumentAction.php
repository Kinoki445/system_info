<?php

namespace App\Containers\AppSection\Document\Actions;

use App\Containers\AppSection\Document\Tasks\DeleteDocumentTask;
use App\Containers\AppSection\Document\UI\API\Requests\DeleteDocumentRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteDocumentAction extends ParentAction
{
    public function __construct(
        private readonly DeleteDocumentTask $deleteDocumentTask,
    ) {
    }

    /**
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteDocumentRequest $request): int
    {
        return $this->deleteDocumentTask->run($request->id);
    }
}
