<?php

namespace App\Containers\AppSection\Document\Models;

use App\Containers\AppSection\Product\Models\Product;
use App\Ship\Parents\Models\Model as ParentModel;

class Document extends ParentModel
{
    protected $fillable = [
        'type',
        'datetime_create'

    ];
    protected string $resourceKey = 'Document';

    public function products()
    {
        return $this->belongsToMany(Product::class, 'documents_products', 'document_id', 'product_id')
            ->withTimestamps()
            ->withPivot('quantity', 'inventory_quantity', 'inventory_error');


    }
}
