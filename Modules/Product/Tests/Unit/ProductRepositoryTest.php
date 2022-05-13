<?php

namespace Modules\Product\Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Product\Entities\Product;
use Modules\Product\Repositories\ProductRepository;

class ProductRepositoryTest extends TestCase
{
    use refreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_respository_product_should_able_return_collection_of_products()
    {
        $products = Product::factory(10)->create();
        $productRepository = new ProductRepository();
        $this->assertEquals(count($productRepository->getAllProducts()), count($products));
        $this->assertDatabaseHas('products', ['id' => $products->first()->id]);
    }



    public function test_respository_product_should_able_create_product()
    {
        $productRepository = new ProductRepository();
        $product = $productRepository->createProduct(['nama' => 'Product Test', 'harga' => '10000', 'keterangan' => 'Product Test', 'persediaan' => '10']);
        $this->assertEquals($product->nama, 'Product Test');
        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }

    public function test_respository_product_should_able_update_product()
    {
        $product = Product::factory()->create();
        $productRepository = new ProductRepository();
        $repo = $productRepository->updateProduct($product->id, ['nama' => 'Product Test', 'harga' => '10000', 'keterangan' => 'Product Test', 'persediaan' => '10']);
        $this->assertEquals($repo->nama, 'Product Test');
    }
    public function test_respository_product_should_able_fetch_specific_product()
    {
        $product = Product::factory()->create();
        $productRepository = new ProductRepository();
        $this->assertEquals($productRepository->getProductById($product->id)->id, $product->id);
    }

    public function test_respository_product_should_able_delete_product()
    {
        $product = Product::factory()->create();
        $productRepository = new ProductRepository();
        $repo = $productRepository->deleteProduct($product->id);
        $this->assertEquals($repo->id, $product->id);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
