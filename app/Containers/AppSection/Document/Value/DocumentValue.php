<?php

namespace App\Containers\AppSection\Document\Value;

use App\Ship\Parents\Values\Value;

class DocumentValue extends Value
{
    protected array $product_id;
    protected array $quantity;
    protected string $type;
    protected string $datetime_create;


    /**
     * @return array
     */
    public function getProductId(): array
    {
        return $this->product_id;
    }

    /**
     * @param array $product_id
     */
    public function setProductId(array $product_id): void
    {
        $this->product_id = $product_id;
    }

    /**
     * @return string
     */
    public function getDatetimeCreate(): string
    {
        return $this->datetime_create;
    }

    /**
     * @param string $datetime_create
     */
    public function setDatetimeCreate(string $datetime_create): void
    {
        $this->datetime_create = $datetime_create;
    }

    /**
     * @return array
     */
    public function getQuantity(): array
    {
        return $this->quantity;
    }

    /**
     * @param array $quantity
     */
    public function setQuantity(array $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

}
