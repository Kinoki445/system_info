<?php

namespace App\Containers\AppSection\Product\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Product\Data\Repositories\ProductRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class ListProductsTask extends ParentTask
{
    public function __construct(
        protected readonly ProductRepository $repository,
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
