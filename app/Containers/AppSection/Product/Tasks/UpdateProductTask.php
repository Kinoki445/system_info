<?php

namespace App\Containers\AppSection\Product\Tasks;

use App\Containers\AppSection\Product\Data\Repositories\ProductRepository;
use App\Containers\AppSection\Product\Models\Product;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateProductTask extends ParentTask
{
    public function __construct(
        protected readonly ProductRepository $repository,
    ) {
    }

    /**
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(array $data, $id): Product
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
