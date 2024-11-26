<?php

namespace App\Containers\AppSection\Document\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Document\Data\Repositories\DocumentRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class ListDocumentsTask extends ParentTask
{
    public function __construct(
        protected readonly DocumentRepository $repository,
    ) {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(): mixed
    {
        return $this->repository->addRequestCriteria()->paginate();
    }
}
