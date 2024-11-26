<?php

namespace App\Containers\AppSection\Document\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Document\Actions\CreateDocumentAction;
use App\Containers\AppSection\Document\Enum\DocumentEnum;
use App\Containers\AppSection\Document\UI\API\Requests\CreateDocumentRequest;
use App\Containers\AppSection\Document\UI\API\Transformers\DocumentTransformer;
use App\Containers\AppSection\Document\Value\DocumentValue;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use function Amp\Iterator\toArray;

class CreateDocumentController extends ApiController
{
    public function __construct(
        private readonly CreateDocumentAction $action,
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     * @throws InvalidTransformerException
     * @throws IncorrectIdException
     */
    public function __invoke(CreateDocumentRequest $request): JsonResponse
    {

        $value = new DocumentValue();
        $value->setType($request->type);
        $value->setDatetimeCreate($request->datetime_create);
        $value->setProductId($request->product_id);

        if($value->getType() != DocumentEnum::INVENTORY->value) {
            $value->setQuantity($request->quantity);
        } else {
            $value->setQuantity([0]);
        }

        $document = $this->action->run($value);

        return $this->created($this->transform($document, DocumentTransformer::class));
    }
}
