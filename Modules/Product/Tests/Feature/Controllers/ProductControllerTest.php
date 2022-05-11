<?php

namespace Modules\Product\Tests\Feature\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Product\Entities\Product;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_router_should_return_collection_products()
    {

        Product::factory(10)->create();
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/products');
        $response->assertStatus(200);
        $response->assertJsonCount(10);
    }

    public function test_should_fail_create_product_with_invalid_request()
    {

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/products', []);
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'nama' => [
                    'The nama field is required.'
                ],
                'harga' => [
                    'The harga field is required.'
                ],
                'keterangan' => [
                    'The keterangan field is required.'
                ],
                'persediaan' => [
                    'The persediaan field is required.'
                ]
            ]
        ]);
    }

    public function test_should_success_create_product_with_valid_request()
    {

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/products', [
            'nama' => 'PD ' . "Product" . '-' . 1039,
            'harga' => 5000,
            'keterangan' => "sometext",
            'persediaan' => 10
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'data' => [
                'id',
                'nama',
                'harga',
                'keterangan',
                'persediaan',
                'created_at',
                'updated_at'
            ]
        ]);
    }

    public function test_should_return_single_product()
    {

        $product = Product::factory()->create();
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/products/' . $product->id);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'nama',
            'harga',
            'keterangan',
            'persediaan',
            'created_at',
            'updated_at'
        ]);
    }

    public function test_should_fail_update_product_with_invalid_request()
    {

        $product = Product::factory()->create();
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/products/' . $product->id, []);
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'nama' => [
                    'The nama field is required.'
                ],
                'harga' => [
                    'The harga field is required.'
                ],
                'keterangan' => [
                    'The keterangan field is required.'
                ],
                'persediaan' => [
                    'The persediaan field is required.'
                ]
            ]
        ]);
    }
    public function test_should_success_update_product_with_valid_data()
    {
        $product = Product::factory()->create();
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/products/' . $product->id, [
            'nama' => 'PD ' . "Product" . '-' . 1039,
            'harga' => 5000,
            'keterangan' => "sometext",
            'persediaan' => 10
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'data' => [
                'id',
                'nama',
                'harga',
                'keterangan',
                'persediaan',
                'created_at',
                'updated_at'
            ]
        ]);
    }

    public function test_should_success_delete_product()
    {
        $product = Product::factory()->create();
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->delete('/api/products/' . $product->id);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'data' => [
                'id',
                'nama',
                'harga',
                'keterangan',
                'persediaan',
                'created_at',
                'updated_at'
            ]
        ]);
    }
}
