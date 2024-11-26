<?php

namespace App\Containers\AppSection\Document\Tasks;

use App\Containers\AppSection\Document\Data\Repositories\DocumentRepository;
use App\Containers\AppSection\Document\Models\Document;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;

class FindDocumentByIdTask extends ParentTask
{
    public function __construct(
        protected readonly DocumentRepository $repository,
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id): Document
    {
        try {
            return $this->repository->find($id);
        } catch (\Exception) {
            throw new NotFoundException();
        }
    }
}
