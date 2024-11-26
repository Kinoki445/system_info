<?php

namespace App\Containers\AppSection\Document\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Document\Models\Document;
use App\Containers\AppSection\Document\Tasks\CreateDocumentTask;
use App\Containers\AppSection\Document\UI\API\Requests\CreateDocumentRequest;
use App\Containers\AppSection\Document\Value\DocumentValue;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateDocumentAction extends ParentAction
{
    public function __construct(
        private readonly CreateDocumentTask $createDocumentTask,
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(DocumentValue $value): Document
    {
        $data = [
            'type' => $value->getType(),
            'datetime_create' => $value->getDatetimeCreate(),
            'product_id' => $value->getProductId(),
            'quantity' => $value->getQuantity(),
        ];


        return $this->createDocumentTask->run($data);
    }
}
