<?php

namespace Tests\Features;

use App\Models\{ Order, Product };
use Packages\Currency\Currency;
use Tests\TestCaseFeature;

class OrdersTest extends TestCaseFeature
{
    public function test_get_order()
    {
        $client = $this->getClient();

        $orderId = $this->fakeOrder()->id;

        $response = $client->get('/order/'. $orderId);

        $body = json_decode($response?->getBody()?->getContents());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('R$ 0,00', $body?->data?->fee);
        $this->assertEquals('R$ 0,00', $body?->data?->net_value);
        $this->assertEquals('R$ 0,00', $body?->data?->gross_value);
        $this->assertEquals(0, $body?->data?->amount);
    }

    public function test_create_order()
    {
        $client = $this->getClient();

        $response = $client->post('/order/', ['form_params'=>[]]);

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_add_product()
    {
        $client = $this->getClient();

        $response = $client->post('/order/add/', [
            'form_params' => [
                'product_id' => $this->fakeProduct()->id,
                'order_id' => $this->fakeOrder()->id
                ]
            ]);
                
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_pricing_order()
    {
        $client = $this->getClient();

        $order = $this->fakeOrder();
        $product = $this->fakeProduct();

        $resp = $client->post('/order/add/', [
            'form_params' => [
                'product_id' => $product->id,
                'order_id' => $order->id
            ]
        ]);

        $response = $client->get('/order/'. $order->id);

        $body = json_decode($response?->getBody()?->getContents());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(Currency::brl($product->fee), $body?->data?->fee);
        $this->assertEquals(Currency::brl($product->net_value), $body?->data?->net_value);
        $this->assertEquals(Currency::brl($product->price), $body?->data?->gross_value);
        $this->assertEquals(1, $body?->data?->amount);
    }

    public function test_pricing_order_calc()
    {
        $client = $this->getClient();

        $order = $this->fakeOrder();
        $product1 = $this->fakeProduct();
        $product2 = $this->fakeProduct();

        $client->post('/order/add/', [
            'form_params' => [
                'product_id' => $product1->id,
                'order_id' => $order->id
            ]
        ]);

        $client->post('/order/add/', [
            'form_params' => [
                'product_id' => $product2->id,
                'order_id' => $order->id
            ]
        ]);

        $response = $client->get('/order/'. $order->id);

        $body = json_decode($response?->getBody()?->getContents());

        $fee = Currency::brl($product1->fee + $product2->fee);
        $net_value = Currency::brl($product1->net_value + $product2->net_value);
        $gross_value = Currency::brl($product1->price + $product2->price);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($fee, $body?->data?->fee);
        $this->assertEquals($net_value, $body?->data?->net_value);
        $this->assertEquals($gross_value, $body?->data?->gross_value);
        $this->assertEquals(2, $body?->data?->amount);
    }

    private function fakeProduct()
    {
        return Product::create([
            "name" => "Notebook Acer Aspire",
            'category_id' => 1,
            "price" => 3000.00,
        ]);
    }

    private function fakeOrder()
    {
        return Order::create([]);   
    }
}