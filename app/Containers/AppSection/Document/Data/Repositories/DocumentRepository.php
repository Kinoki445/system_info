<?php

namespace App\Containers\AppSection\Document\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class DocumentRepository extends ParentRepository
{
    protected $fieldSearchable = [
        'id' => '=',
    ];
}
