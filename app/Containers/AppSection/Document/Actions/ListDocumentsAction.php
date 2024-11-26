<?php

namespace App\Containers\AppSection\Document\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Document\Tasks\ListDocumentsTask;
use App\Containers\AppSection\Document\UI\API\Requests\ListDocumentsRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class ListDocumentsAction extends ParentAction
{
    public function __construct(
        private readonly ListDocumentsTask $listDocumentsTask,
    ) {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(ListDocumentsRequest $request): mixed
    {
        return $this->listDocumentsTask->run();
    }
}
