<?php

namespace App\Containers\AppSection\Product\Models;

use App\Containers\AppSection\Document\Models\Document;
use App\Ship\Parents\Models\Model as ParentModel;

class Product extends ParentModel
{

    protected $fillable = [
        'name',
        'price',
    ];

    protected string $resourceKey = 'Product';

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'documents_products', 'product_id', 'document_id')
            ->withTimestamps()
            ->withPivot('quantity', 'inventory_quantity', 'inventory_error');
    }

}
