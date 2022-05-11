<?php

namespace Modules\Product\Interface;

interface ProductInterface
{
    /**
     * Get all products
     */
    public function getAllProducts();
    /**
     * get product by id
     * @param int $id
     */
    public function getProductById($id);
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function createProduct(array $arraProduct);
    /**
     * Update the specified resource in storage.
     * @param array $arrayProduct
     * @param int $id
     */
    public function updateProduct($id, array $arraProduct);
    /**
     * Delete the specified resource from storage.
     * @param int $id
     */
    public function deleteProduct($id);
}
