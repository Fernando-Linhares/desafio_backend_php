<?php

namespace Tests\Features;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Tests\TestCaseFeature;

class ProductsTest extends TestCaseFeature
{
    public function test_index_route()
    {
        $client = $this->getClient();
        $response = $client->get('/products/');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_show_route()
    {
        $client = $this->getClient();

        $product = $this->fakeProduct();

        $response = $client->get('/products/' . $product->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_store_route()
    {
        $client = $this->getClient();

        $response = $client->post('/products/', [
            'form_params' => [
                'name' => 'notebook acer',
                'price' => 4000,
                'category_id' => 1,
            ]
        ]);

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_update_route()
    {
        $client = $this->getClient();

        $product = $this->fakeProduct();

        $response = $client->put('/products/'. $product->id, [
            'form_params' => [
                'name' => 'notebook acer',
                'price' => 4000,
                'category_id' => 1,
            ]
        ]);

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_delete_route()
    {
        $client = $this->getClient();

        $product = $this->fakeProduct();

        $response = $client->delete('/products/'. $product->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    private function fakeProduct()
    {
        return \App\Models\Product::create([
            'name' => 'notebook acer',
            'price' => 4000,
            'category_id' => 1,
        ]);
    }
}