<?php

namespace App\Containers\AppSection\Document\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Document\Models\Document;
use App\Containers\AppSection\Document\Tasks\UpdateDocumentTask;
use App\Containers\AppSection\Document\UI\API\Requests\UpdateDocumentRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateDocumentAction extends ParentAction
{
    public function __construct(
        private readonly UpdateDocumentTask $updateDocumentTask,
    ) {
    }

    /**
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function run(UpdateDocumentRequest $request): Document
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        return $this->updateDocumentTask->run($data, $request->id);
    }
}
