<?php

namespace App\Containers\AppSection\Product\Actions;

use App\Containers\AppSection\Product\Tasks\DeleteProductTask;
use App\Containers\AppSection\Product\UI\API\Requests\DeleteProductRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteProductAction extends ParentAction
{
    public function __construct(
        private readonly DeleteProductTask $deleteProductTask,
    ) {
    }

    /**
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteProductRequest $request): int
    {
        return $this->deleteProductTask->run($request->id);
    }
}
