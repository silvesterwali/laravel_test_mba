<?php

namespace Modules\Product\Repositories;

use Modules\Product\Entities\Product;
use Modules\Product\Interface\ProductInterface;

class ProductRepository implements ProductInterface
{
    public function getAllProducts()
    {
        return Product::all();
    }
    public function getProductById($id)
    {
        return Product::findOrFail($id);
    }
    public function createProduct(array $arraProduct)
    {
        return Product::create($arraProduct);
    }
    public function updateProduct($id, array $arraProduct)
    {
        $product = Product::findOrFail($id);
        $product->update($arraProduct);
        return $product;
    }
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return $product;
    }
}
