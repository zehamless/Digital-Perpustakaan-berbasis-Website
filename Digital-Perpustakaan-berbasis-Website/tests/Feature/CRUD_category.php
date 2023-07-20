<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CRUD_category extends TestCase
{
    use refreshDatabase;

    /**
     * Index test.
     * @test
     * @return void
     */
    public function testIndex(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response= $this->post('/categories', [
            'name' => 'Test Category',
        ]);
        $response = $this->get('/categories');
        $response->assertStatus(200)
        ->assertJson([
            'message' => 'Berhasil menampilkan kategori',
        ]);
    }

    /**
     * Store test.
     * @test
     * @return void
     */
    public function testStore(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/categories', [
            'name' => 'Test Category',
        ]);
        $response->assertStatus(201)
        ->assertJson([
            'message' => 'Kategori berhasil ditambahkan',
            'category' => [
                'name' => 'Test Category',
            ],
        ]);
    }

    /**
     * Update test.
     * @test
     * @return void
     */
    public function testUpdate(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/categories', [
            'name' => 'Test Category',
        ]);
        $response = $this->post('/categories', [
            'name' => 'Test Category 2',
        ]);
        $category = $response['category'];
        $response = $this->put('/categories/' . $category['id'], [
            'name' => 'Test Category Updated',
        ]);
        $response->assertStatus(200)
        ->assertJson([
            'message' => 'Kategori berhasil diubah',
            'category' => [
                'name' => 'Test Category Updated',
                'id' => $category['id'],
            ],
        ]);
    }
}
