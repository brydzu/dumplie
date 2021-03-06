<?php

declare (strict_types = 1);

namespace Dumplie\Inventory\Infrastructure\InMemory;

use Dumplie\Inventory\Domain\Exception\ProductNotFound;
use Dumplie\Inventory\Domain\Product;
use Dumplie\Inventory\Domain\Products;
use Dumplie\SharedKernel\Domain\Product\SKU;

final class InMemoryProducts implements Products
{
    /**
     * @var Product[]
     */
    private $products = [];

    /**
     * @param Product[] $products
     */
    public function __construct(array $products = [])
    {
        foreach ($products as $product) {
            $this->add($product);
        }
    }

    /**
     * @param Product $product
     */
    public function add(Product $product)
    {
        $this->products[(string) $product->sku()] = $product;
    }

    /**
     * @param SKU $SKU
     *
     * @return Product
     *
     * @throws ProductNotFound - when product with given SKU were not found
     */
    public function getBySku(SKU $SKU): Product
    {
        if (isset($this->products[(string) $SKU])) {
            return $this->products[(string) $SKU];
        }

        throw ProductNotFound::bySku($SKU);
    }
}
