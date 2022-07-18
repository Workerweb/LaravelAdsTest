<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Ad;
class AdTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('/api/ad');

        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_show()
    {
        $ad = Ad::factory()->create([
            "name" => "Test",
            "description" => "Test",
            "price" => 100
        ]);

        $this->json('GET', 'api/ad/' . $ad->id, [], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "data" => [
                    "name" => "Test",
                    "price" => "100.00",
                    "main_photo_url" => null
                ],
                "message" => "Объявление"
            ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_store()
    {
        $data = array(
            'name' => 'test',
            'description' => 'test',
            'price' => 100,
            'photos' => [
                ['url' => 'https://zos.alipayobjects.com/rmsportal/ODTLcjxAfvqbxHnVXCYX.png']
            ]
        );
        $this->json('POST', 'api/ad', $data, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJson([
                "success" => true,
                "data" => [],
                "message" => "Объявление успешно сохранено"
            ]);
    }
}
