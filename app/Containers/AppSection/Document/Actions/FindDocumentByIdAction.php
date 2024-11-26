<?php

namespace App\Containers\AppSection\Document\Actions;

use App\Containers\AppSection\Document\Models\Document;
use App\Containers\AppSection\Document\Tasks\FindDocumentByIdTask;
use App\Containers\AppSection\Document\UI\API\Requests\FindDocumentByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindDocumentByIdAction extends ParentAction
{
    public function __construct(
        private readonly FindDocumentByIdTask $findDocumentByIdTask,
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run(FindDocumentByIdRequest $request): Document
    {
        return $this->findDocumentByIdTask->run($request->id);
    }
}
