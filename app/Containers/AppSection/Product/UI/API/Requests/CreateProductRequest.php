<?php

namespace App\Containers\AppSection\Product\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class CreateProductRequest extends ParentRequest
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
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ];
    }

    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
