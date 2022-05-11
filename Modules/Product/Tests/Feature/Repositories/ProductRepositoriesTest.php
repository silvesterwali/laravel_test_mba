<?php

namespace Modules\Product\Tests\Feature\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Product\Repositories\ProductRepository;
use Modules\Product\Entities\Product;

class ProductRepositoriesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_repositories_product_should_fetch_all_products()
    {
        Product::factory(10)->create();
        $repositoryProduct = new ProductRepository();
        $this->assertEquals(count($repositoryProduct->getAllProducts()), 10);
    }

    public function test_repositories_product_should_fetch_product_by_id()
    {
        $product = Product::factory()->create();
        $repositoryProduct = new ProductRepository();
        $repo = $repositoryProduct->getProductById($product->id);
        $this->assertEquals($repo->id, $product->id);
    }

    public function test_repositories_product_should_create_product()
    {
        $repositoryProduct = new ProductRepository();
        $product = $repositoryProduct->createProduct(['nama' => 'Product Test', 'harga' => '10000', 'keterangan' => 'Product Test', 'persediaan' => '10']);
        $this->assertEquals($product->nama, 'Product Test');
    }

    public function test_respositories_product_should_update_product()
    {
        $product = Product::factory()->create();
        $repositoryProduct = new ProductRepository();
        $repo = $repositoryProduct->updateProduct($product->id, ['nama' => 'Product Test', 'harga' => '10000', 'keterangan' => 'Product Test', 'persediaan' => '10']);
        $this->assertEquals($repo->nama, 'Product Test');
    }

    public function test_respositories_product_should_delete_product()
    {
        $product = Product::factory()->create();
        $repositoryProduct = new ProductRepository();
        $repo = $repositoryProduct->deleteProduct($product->id);
        $this->assertEquals($repo->id, $product->id);
    }
}
