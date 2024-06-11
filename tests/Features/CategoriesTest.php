<?php

namespace Tests\Features;

use Tests\TestCaseFeature;

class CategoriesTest extends TestCaseFeature
{
    public function test_index_route()
    {
        $client = $this->getClient();

        $response = $client->get('/categories/');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_show_route()
    {
        $client = $this->getClient();

        $category = $this->fakeCategory();

        $response = $client->get('/categories/'. $category->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_store_route()
    {
        $client = $this->getClient();

        $response = $client->post('/categories/', [
            'form_params' => [
                'name' => 'Outra categoria',
                'fee' => 20
            ]
        ]);

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_update_route()
    {
        $client = $this->getClient();

        $category = $this->fakeCategory();

        $response = $client->put('/categories/'. $category->id, [
            'form_params' => [
                'name' => 'Outra categoria',
                'fee' => 10
            ]
        ]);

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_delete_route()
    {
        $client = $this->getClient();
        
        $category = $this->fakeCategory();

        $response = $client->delete('/categories/'. $category->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    private function fakeCategory()
    {
        return \App\Models\Category::create([
            'name' => 'Example Category',
            'fee' => 20
        ]);
    }
}