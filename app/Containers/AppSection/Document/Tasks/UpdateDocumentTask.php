<?php

namespace App\Containers\AppSection\Document\Tasks;

use App\Containers\AppSection\Document\Data\Repositories\DocumentRepository;
use App\Containers\AppSection\Document\Models\Document;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateDocumentTask extends ParentTask
{
    public function __construct(
        protected readonly DocumentRepository $repository,
    ) {
    }

    /**
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(array $data, $id): Document
    {
        try {
            return $this->repository->update($data, $id);
        } catch (ModelNotFoundException) {
            throw new NotFoundException();
        } catch (\Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
