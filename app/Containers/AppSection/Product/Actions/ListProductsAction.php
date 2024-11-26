<?php

namespace App\Containers\AppSection\Product\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Product\Tasks\ListProductsTask;
use App\Containers\AppSection\Product\UI\API\Requests\ListProductsRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class ListProductsAction extends ParentAction
{
    public function __construct(
        private readonly ListProductsTask $listProductsTask,
    ) {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(ListProductsRequest $request): mixed
    {
        return $this->listProductsTask->run();
    }
}
