<?php

namespace App\Containers\AppSection\Product\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class ListProductsRequest extends ParentRequest
{
    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    protected array $decode = [
        // 'id',
    ];

    protected array $urlParameters = [
        // 'id',
    ];

    public function rules(): array
    {
        return [
            // 'id' => 'required',
        ];
    }

    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
