<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CRUD_book extends TestCase
{
    use refreshDatabase;
    /**
     * Store test.
     * @test
     * @return void
     */
    public function testStore(): void
    {
        //login as user
        $user = User::factory()->create();
        $this->actingAs($user);
        $category = Category::factory()->create();

        //upload cover
        Storage::fake('public');
        $cover = UploadedFile::fake()->image('cover.jpg');

        //upload file
        $file = UploadedFile::fake()->create('file.pdf');

        //create a book
        $response = $this->post('/books', [
            'title' => 'Buku 1',
            'description' => 'Deskripsi buku 1',
            'amount' => 3,
            'cover' => $cover,
            'file' => $file,
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);

        //check book created
        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Buku berhasil ditambahkan',
                'book' => [
                    'title' => 'Buku 1',
                    'description' => 'Deskripsi buku 1',
                    'amount' => 3,
                    'cover' => 'covers/' . $cover->hashName(),
                    'file_path' => 'files/' . $file->hashName(),
                    'category_id' => $category->id,
                    'user_id' => $user->id,
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
        //login as user
        $user = User::factory()->create();
        $this->actingAs($user);
        $category = Category::factory()->create();

        //upload cover
        Storage::fake('public');
        $cover = UploadedFile::fake()->image('cover.jpg');

        //upload file
        $file = UploadedFile::fake()->create('file.pdf');

        //create a book
        $response = $this->post('/books', [
            'title' => 'Buku 1',
            'description' => 'Deskripsi buku 1',
            'amount' => 3,
            'cover' => $cover,
            'file' => $file,
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);

        //check book created
        $response->assertStatus(201);

        //update book
        $book = $response['book'];
        $response = $this->put('/books/' . $book['id'], [
            'title' => 'Buku 2',
            'description' => 'Deskripsi buku 2',
            'amount' => 3,
            'cover' => $cover,
            'file' => $file,
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);

        //check book updated
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Buku berhasil diupdate',
                'book' => [
                    'title' => 'Buku 2',
                    'description' => 'Deskripsi buku 2',
                    'amount' => 3,
                    'cover' => 'covers/' . $cover->hashName(),
                    'file_path' => 'files/' . $file->hashName(),
                    'category_id' => $category->id,
                    'user_id' => $user->id,
                ],
            ]);
    }

    /**
     * Delete test.
     * @test
     * @return void
     */
    public function testDelete(): void
    {
        //login as user
        $user = User::factory()->create();
        $this->actingAs($user);
        $category = Category::factory()->create();

        //upload cover
        Storage::fake('public');
        $cover = UploadedFile::fake()->image('cover.jpg');

        //upload file
        $file = UploadedFile::fake()->create('file.pdf');

        //create a book
        $response = $this->post('/books', [
            'title' => 'Buku 1',
            'description' => 'Deskripsi buku 1',
            'amount' => 3,
            'cover' => $cover,
            'file' => $file,
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);

        //check book created
        $response->assertStatus(201);

        //delete book
        $book = $response['book'];
        $response = $this->delete('/books/' . $book['id']);

        //check book deleted
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Buku berhasil dihapus',
            ]);
    }
}
